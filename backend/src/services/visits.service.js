import fs from 'fs/promises';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const VISITS_FILE = path.join(__dirname, '../../data/visits.json');

// Initialize the file if it doesn't exist
async function initFile() {
  try {
    await fs.access(VISITS_FILE);
  } catch {
    // Ensure the data directory exists before writing
    await fs.mkdir(path.dirname(VISITS_FILE), { recursive: true });
    await fs.writeFile(VISITS_FILE, JSON.stringify({ ips: [] }, null, 2));
  }
}

export async function getAndRecordVisit(ip) {
  await initFile();
  const data = JSON.parse(await fs.readFile(VISITS_FILE, 'utf-8'));
  
  if (ip && !data.ips.includes(ip)) {
    data.ips.push(ip);
    await fs.writeFile(VISITS_FILE, JSON.stringify(data, null, 2));
  }
  
  return data.ips.length;
}