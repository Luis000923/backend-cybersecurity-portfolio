import { Router } from 'express';

import { submitContact } from '../controllers/contact.controller.js';
import { validateRequest } from '../middleware/validate.js';
import { contactLimiter } from '../middleware/rate-limiters.js';
import { contactSchema } from '../validators/contact.validator.js';

const router = Router();

router.post('/', contactLimiter, contactSchema, validateRequest, submitContact);

export default router;