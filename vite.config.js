import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/js/another-portfolio.js',
            'resources/css/app.css',
            'resources/css/daisy.css',
            'resources/css/another-portfolio.css',
            'resources/css/flag-icons.css',

            'resources/css/filament/admin/theme.css',
            'resources/css/filament/guests/theme.css',
        ]),
    ],
});