import { createApp, h } from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import { ZiggyVue } from 'ziggy-js';
import Ziggy from '@/ziggy';

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;
import 'admin-lte/dist/js/adminlte.min.js';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import { createInertiaApp } from '@inertiajs/vue3';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});
