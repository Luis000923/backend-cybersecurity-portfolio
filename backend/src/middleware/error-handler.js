export function errorHandler(error, _request, response, _next) {
	// Log the full error for server-side diagnostics (kept generic for clients)
	try {
		console.error(error);
		// Also append error stack to a local diagnostic file for this dev session
		import('fs').then((fs) => {
			try {
				const stack = error && (error.stack || String(error));
				fs.appendFileSync('backend-error.log', `\n[${new Date().toISOString()}]\n${stack}\n`);
			} catch (e) {
				// ignore file logging failures
			}
		});
	} catch (e) {
		// ignore logging errors
	}

	const status = error?.status || 500;
	const payload = { message: status === 500 ? 'Internal server error.' : error.message };

	if (error?.details && status === 400) {
		payload.details = error.details;
	}

	response.status(status).json(payload);
}