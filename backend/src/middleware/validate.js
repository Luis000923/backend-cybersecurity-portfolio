import { validationResult } from 'express-validator';

export function validateRequest(req, _res, next) {
  const result = validationResult(req);
  if (result.isEmpty()) return next();

  const errors = result.array().map((e) => ({ field: e.param, msg: e.msg }));
  const err = new Error('Validation failed');
  err.status = 400;
  err.details = errors;
  next(err);
}
