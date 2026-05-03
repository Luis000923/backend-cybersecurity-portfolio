import rateLimit from 'express-rate-limit';

export const globalLimiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 200, // allow more for general endpoints
  standardHeaders: true,
  legacyHeaders: false,
});

export const contactLimiter = rateLimit({
  windowMs: 60 * 60 * 1000, // 1 hour
  max: 6, // max 6 contact submissions per IP per hour
  message: { message: 'Too many contact requests from this IP, please try later.' },
  standardHeaders: true,
  legacyHeaders: false,
});
