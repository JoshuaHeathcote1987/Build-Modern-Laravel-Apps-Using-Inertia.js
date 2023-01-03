import { createApp, h } from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import Layout from './Shared/Layout.vue'
import NavLink from './Shared/NavLink.vue'


InertiaProgress.init({
  
    // The color of the progress bar.
    color: '#FE6D73',
  
    // Whether to include the default NProgress styles.
    includeCSS: true,
  
    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})

createInertiaApp({
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );

        page.then((module) => {
            if (module.default.layout === undefined) {
                module.default.layout = Layout;   
            }
        });

        return page;
    },
    
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Head", Head)
            .component("Link", Link)
            .component("NavLink", NavLink)
            .mount(el)
    },

    title: title => `My app - ${title}`
    // title: title => title + " - My App",
});

// #227C9D #17C3B2 #FFCB77 #FEF9EF #FE6D73