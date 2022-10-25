import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'

export default defineConfig({

    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            'Shared': path.resolve('resources/js/Pages/Shared'),
        },
    },

    /* '@': path.resolve('resources/js'),
    'Shared': path.resolve('resources/js/Pages/Shared'), */

    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
