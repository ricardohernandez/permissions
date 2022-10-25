import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { translations } from './Mixins/translations';
import { permissions } from './Mixins/permissions';
import { createPinia } from 'pinia';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {

        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mixin(permissions)
            .mixin(translations)

        app.config.globalProperties.$filters = {
            truncate(value) {
                if (value.length > 15) {
                    return value.substring(0, 15) + '...';
                } else {
                    return value
                }

            },
            // Put the rest of your filters here
        }

        app.use(createPinia());

        app.mount(el);
    },
});

InertiaProgress.init({ color: '#1A56DB' });

