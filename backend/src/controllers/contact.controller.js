import { processContact } from '../services/contact.service.js';

export async function submitContact(request, response, next) {
	try {
		console.info('submitContact body:', request.body);
		const { name, email, message } = request.body ?? {};

		// `express-validator` has already validated and sanitized inputs via middleware.
		await processContact({ name, email, message });

		return response.status(202).json({ message: 'Contact request received.' });
	} catch (err) {
		next(err);
	}
}