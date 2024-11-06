require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'; // Correctly import Inertia
import { InertiaProgress } from '@inertiajs/progress';
import { store } from "./store";
import { theme } from './theme';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Raze';

InertiaProgress.init({
    delay: 10,
    includeCSS: true,
    showSpinner: false,
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const vueApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(store)
            .mixin({ methods: { route } });

        // Call `initializeComponents` initially on first load
        theme();

        // Call `initializeComponents` on each Inertia navigation event
        Inertia.on('navigate', () => {
            theme();
        });

        vueApp.mount(el);
        return vueApp;
    },
});