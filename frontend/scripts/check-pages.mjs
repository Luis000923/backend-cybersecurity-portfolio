import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const root = path.join(path.dirname(fileURLToPath(import.meta.url)), '..');
const pagesDir = path.join(root, 'src', 'pages');

if (!fs.existsSync(pagesDir)) {
  console.error(
    `[astro] Missing directory: ${pagesDir}\n` +
      'Astro cannot emit index.html without src/pages. Deploy the full repo (git push) or fix the Hostinger source path.'
  );
  process.exit(1);
}

const astroPages = fs.readdirSync(pagesDir).filter((f) => f.endsWith('.astro'));
if (astroPages.length === 0) {
  console.error(`[astro] No .astro files in ${pagesDir}`);
  process.exit(1);
}
