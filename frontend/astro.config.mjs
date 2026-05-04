import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  output: 'static',
  // Default location frontend/dist — Hostinger and most static hosts expect
  // output inside the app root, not ../dist (repo root), or publish step fails.
  outDir: 'dist',
  compressHTML: true,
  vite: {
    build: {
      minify: false,
      cssMinify: false,
      sourcemap: false,
    },
    optimizeDeps: {
      exclude: ['esbuild']
    }
  },
});
