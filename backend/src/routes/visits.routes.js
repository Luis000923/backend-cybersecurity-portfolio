import express from 'express';
import { getAndRecordVisit } from '../services/visits.service.js';

const router = express.Router();

router.get('/', async (req, res, next) => {
  try {
    const ip = req.headers['x-forwarded-for'] || req.socket.remoteAddress;
    const count = await getAndRecordVisit(ip);
    res.json({ count });
  } catch (error) {
    next(error);
  }
});

export default router;