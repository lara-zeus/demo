import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                `resources/css/filament/admin/theme.css`,
                'resources/css/app.css',
                'resources/css/flag-icons.css',
                //'resources/css/filament/guests/theme.css',
            ],
            refresh: true,
        }),
    ],
});