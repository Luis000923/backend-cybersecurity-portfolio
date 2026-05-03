import { Router } from 'express';
import { getProjects } from '../services/projects.service.js';

const router = Router();

router.get('/', (req, res, next) => {
  try {
    console.info('GET /api/projects from', req.ip || req.headers['x-forwarded-for'] || 'unknown');
    const list = getProjects();
    res.json({ projects: list });
  } catch (err) {
    next(err);
  }
});

export default router;
