// @ts-check
import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  outDir: '../dist',
  publicDir: '../public',
  trailingSlash: 'always',
  vite: {
    optimizeDeps: {
      exclude: ['esbuild']
    }
  },
});
