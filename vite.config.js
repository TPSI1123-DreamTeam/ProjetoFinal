import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/welcome.css',
                'resources/css/welcomeFooter.css',
                'resources/css/welcomeHeader.css',
                'resources/css/dashboard.css',
                'resources/css/login.css',
                'resources/css/register.css',
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/fadeInTitle.js',
                'resources/js/carouselEvent.js',
                'resources/js/carouselEventPrivate.js',
                'resources/js/toggle-sidebar.js'
            ],
            refresh: true,
        }),
    ],
});
