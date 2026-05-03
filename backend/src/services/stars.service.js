import fs from 'fs/promises';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const STARS_FILE = path.join(__dirname, '../../data/stars.json');

async function initFile() {
  try {
    await fs.access(STARS_FILE);
  } catch {
    await fs.mkdir(path.dirname(STARS_FILE), { recursive: true });
    await fs.writeFile(STARS_FILE, JSON.stringify({ total: 0, ips: [] }, null, 2));
  }
}

export async function getStars() {
  await initFile();
  const data = JSON.parse(await fs.readFile(STARS_FILE, 'utf-8'));
  return { total: data.total, count: data.ips.length };
}

export async function addStar(ip) {
  await initFile();
  const data = JSON.parse(await fs.readFile(STARS_FILE, 'utf-8'));

  const normalizedIp = (ip || '').replace(/^::ffff:/, '');

  if (data.ips.includes(normalizedIp)) {
    return { ok: false, reason: 'already_voted', total: data.total };
  }

  data.total += 1;
  data.ips.push(normalizedIp);
  await fs.writeFile(STARS_FILE, JSON.stringify(data, null, 2));

  return { ok: true, total: data.total };
}
