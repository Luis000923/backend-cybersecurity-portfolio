import { body } from 'express-validator';

export const contactSchema = [
  body('name')
    .trim()
    .isLength({ min: 1, max: 100 })
    .withMessage('Name is required and must be 1-100 chars')
    .escape(),
  body('email')
    .trim()
    .isEmail()
    .withMessage('Valid email is required')
    .normalizeEmail(),
  body('message')
    .trim()
    .isLength({ min: 1, max: 2000 })
    .withMessage('Message is required and must be 1-2000 chars')
    .escape(),
];
