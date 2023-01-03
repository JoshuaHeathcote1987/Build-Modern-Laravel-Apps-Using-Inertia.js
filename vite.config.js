import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// None of these fixed the error 'Uncaught (in promise) ReferenceError: require is not defined'
import vue from '@vitejs/plugin-vue'
import { viteCommonjs } from '@originjs/vite-plugin-commonjs'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        viteCommonjs(),
    ],
});
