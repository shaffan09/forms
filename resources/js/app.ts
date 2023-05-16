import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import Layout from "@/Shared/Layout.vue"

createInertiaApp({
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 250,
    // The color of the progress bar...
    color: '#5b65cc',
    // Whether to include the default NProgress styles...
    includeCSS: true,
    // Whether the NProgress spinner will be shown...
    showSpinner: false,
  },
  resolve: name => {
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
  setup({el, App, props, plugin}) {
    createApp({render: () => h(App, props)})
      .use(plugin)
      .mount(el)
  },

  title: (title) => title ? `Forms - ${title}` : 'Forms',
})
