import Vue from 'vue';
import { api, configStore } from '@tager/admin-core';

import '@/assets/css/index.css';

import router from '@/router';
import config from '@/config/config.json';
import App from '@/views/App.vue';
import { registerComponents } from '@/components';

registerComponents();

configStore.setConfig(config);

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');
