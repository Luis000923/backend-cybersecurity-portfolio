import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  output: 'static',
  vite: {
    build: {
      minify: false,
    },
    optimizeDeps: {
      exclude: ['esbuild']
    }
  },
});
