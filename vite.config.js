import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/welcome-page/welcome.css',
                'resources/css/welcome-page/welcomeFooter.css',
                'resources/css/welcome-page/welcomeHeader.css',
                'resources/css/dashboard/dashboard.css',
                'resources/css/login.css',
                'resources/css/register.css',
                'resources/css/client-side/app.css', 
                'resources/js/app.js',
                'resources/js/hidder.js',
                'resources/js/dropdownEvent.js',
                'resources/js/fadeInTitle.js',
                'resources/js/carouselEvent.js',
                'resources/js/carouselEventPrivate.js',
                'resources/js/toggle-sidebar.js',
                'resources/js/formListEvents.js',
                'resources/js/formListEventsManager.js',
                'resources/js/form-create-event.js'
            ],
            refresh: true,
        }),
    ],
});
