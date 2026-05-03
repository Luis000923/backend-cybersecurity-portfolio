import express from 'express';
import { getStars, addStar } from '../services/stars.service.js';

const router = express.Router();

// GET /api/stars — returns total stars
router.get('/', async (req, res, next) => {
  try {
    const data = await getStars();
    res.json(data);
  } catch (err) {
    next(err);
  }
});

// POST /api/stars — add a star (one per IP)
router.post('/', async (req, res, next) => {
  try {
    const ip = (req.headers['x-forwarded-for'] || req.socket.remoteAddress || '').toString().split(',')[0].trim();
    const result = await addStar(ip);

    if (!result.ok) {
      return res.status(409).json({ message: 'Ya votaste desde esta IP.', total: result.total });
    }

    res.status(201).json({ message: 'Estrella registrada.', total: result.total });
  } catch (err) {
    next(err);
  }
});

export default router;
