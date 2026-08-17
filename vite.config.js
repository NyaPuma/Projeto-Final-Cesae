import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/early-theme.js',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/swagger/swagger-theme.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: 'localhost', // Force IPv4 instead of IPv6 [::1]
        watch: {
            ignored: [
                '**/storage/**',
                '**/bootstrap/cache/**',
                '**/public/build/**',
                '**/vendor/**',
            ],
        },
    },
});
