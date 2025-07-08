import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/public/build/', // ⬅️ penting untuk struktur kamu
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // ⬅️ hasil build masuk ke sini
        emptyOutDir: true,
    },
});