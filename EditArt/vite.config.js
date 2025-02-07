import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/guest.scss',
                'resources/js/guest.js',
                'resources/js/app.js',
                'resources/js/admin.js',
                'resources/js/quill.js',
                'resources/js/cart.js',
                'resources/js/filter.js',
                'resources/js/vendas.js',
                'resources/js/wishList.js'
            ],
            refresh: true,
        }),
    ],
});
