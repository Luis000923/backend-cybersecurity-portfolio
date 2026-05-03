import express from 'express';
import helmet from 'helmet';
import cors from 'cors';

import sanitizeInputs from './middleware/sanitize-inputs.js';
import { globalLimiter } from './middleware/rate-limiters.js';

import healthRoutes from './routes/health.routes.js';
import contactRoutes from './routes/contact.routes.js';
import projectsRoutes from './routes/projects.routes.js';
import visitsRoutes from './routes/visits.routes.js';
import starsRoutes from './routes/stars.routes.js';
import { notFoundHandler } from './middleware/not-found.js';
import { errorHandler } from './middleware/error-handler.js';

const app = express();

app.disable('x-powered-by');
app.set('trust proxy', 1);

// Simple request logger for debugging (kept minimal)
app.use((req, _res, next) => {
	try {
		console.info('Incoming', req.method, req.path);
	} catch (e) {
		// ignore
	}
	next();
});

app.use(
	helmet({
		contentSecurityPolicy: {
			directives: {
				defaultSrc: ["'self'"],
				scriptSrc: ["'self'"],
				styleSrc: ["'self'", "'unsafe-inline'"],
				imgSrc: ["'self'", 'data:'],
			},
		},
	}),
);

// CORS: allow explicit origins via env or fallback to localhost for dev.
app.use(
	cors({
		origin: (origin, cb) => {
			const allowed = process.env.CORS_ORIGIN?.split(',').map((v) => v.trim()).filter(Boolean) || [];
			
			// Allow if no origin (like mobile apps or curl) or if in development
			if (!origin || !process.env.NODE_ENV || process.env.NODE_ENV === 'development') {
				return cb(null, true);
			}

			if (allowed.includes(origin)) {
				return cb(null, true);
			}
			
			console.warn('CORS blocked for origin:', origin);
			return cb(new Error('CORS not allowed'));
		},
		methods: ['GET', 'POST'],
		credentials: true,
	}),
);

app.use(express.json({ limit: '100kb' }));
app.use(express.urlencoded({ extended: false, limit: '100kb' }));

// Global rate limiter (less strict than per-route limiters)
// app.use(globalLimiter);

// Basic sanitization to avoid NoSQL injection / XSS in incoming payloads
// Disabled for now (caused runtime errors in this environment). Consider re-enabling with a vetted sanitizer library in production.
// app.use(sanitizeInputs);

app.use('/api/health', healthRoutes);
app.use('/api/contact', contactRoutes);
app.use('/api/projects', projectsRoutes);
app.use('/api/visits', visitsRoutes);
app.use('/api/stars', starsRoutes);

// Also expose legacy /contact for simple frontends or deployments without /api prefix
app.use('/contact', contactRoutes);

app.use(notFoundHandler);
app.use(errorHandler);

export default app;