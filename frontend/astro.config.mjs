import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  output: 'static',
  compressHTML: true,
  vite: {
    build: {
      minify: false,
    },
    optimizeDeps: {
      exclude: ['esbuild']
    }
  },
});
