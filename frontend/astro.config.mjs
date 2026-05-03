import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  // Usamos los valores por defecto (dist y public locales)
  // para que Hostinger no se confunda
  vite: {
    optimizeDeps: {
      exclude: ['esbuild']
    }
  },
});
