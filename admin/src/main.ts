import Vue, { CreateElement } from 'vue';

import * as Sentry from '@sentry/browser';
import { Vue as VueIntegration } from '@sentry/integrations';
import VueCompositionApi, { createApp } from '@vue/composition-api';

import { configStore, i18n } from '@tager/admin-services';
import { AdminUiPlugin } from '@tager/admin-ui';
import { AdminLayoutPlugin } from '@tager/admin-layout';

import '@tager/admin-ui/dist/admin-ui.css';

import '@/assets/css/index.css';

import router from '@/router';

import config from '@/config/config.json';

import App from '@/views/App.vue';

configStore.setConfig(config);

if (process.env.VUE_APP_SENTRY_DSN) {
  Sentry.init({
    enabled:
      process.env.NODE_ENV === 'production' &&
      process.env.VUE_APP_ENV !== 'local',
    dsn: process.env.VUE_APP_SENTRY_DSN,
    environment: [
      process.env.VUE_APP_SENTRY_ENVIRONMENT,
      process.env.VUE_APP_ENV,
    ].join('_'),
    integrations: [new VueIntegration({ Vue, attachProps: true })],
  });
}

Vue.use(VueCompositionApi);
Vue.use(AdminUiPlugin);
Vue.use(AdminLayoutPlugin);

i18n.init().then(() => {
  const app = createApp({
    router,
    render: (h: CreateElement) => h(App),
  });

  app.use(VueCompositionApi);
  app.use(i18n.getPlugin());
  app.use(AdminUiPlugin);
  app.use(AdminLayoutPlugin);

  app.mount('#app');
});
