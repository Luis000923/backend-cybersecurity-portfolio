import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  output: 'static',
  outDir: '../dist',
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
