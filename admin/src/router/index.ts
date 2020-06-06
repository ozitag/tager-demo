import Vue, { CreateElement, VNode } from 'vue';
import VueRouter from 'vue-router';
import { CONSTANTS } from '@tager/admin-core';

import NotFound from '@/views/NotFound/index.vue';
import { CustomRouteConfig } from '@/typings/common';

Vue.use(VueRouter);

const HomePage = Vue.extend({
  render(createElement: CreateElement): VNode {
    return createElement('div', {}, 'Home page');
  }
});

const routes: Array<CustomRouteConfig> = [
  {
    path: '/',
    component: HomePage,
    meta: { getBreadcrumbs: () => [{ path: '/', label: 'Home' }] }
  },
  {
    path: '*',
    component: NotFound
  }
];

const router = new VueRouter({
  mode: 'history',
  base: CONSTANTS.BASE_PATH,
  routes
});

export default router;
