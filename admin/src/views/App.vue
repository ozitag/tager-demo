<template>
  <base-layout
    v-bind:config="config"
    v-bind:sidebar-menu-list="sidebarMenuList"
  >
    <router-view />
  </base-layout>
</template>

<script lang="ts">
import Vue from 'vue';
import { BaseLayout } from '@tager/admin-core';

import config from '@/config/config.json';
import { MENU_ITEM_LIST } from '@/config/sidebarMenu';

export default Vue.extend({
  name: 'App',
  components: { BaseLayout },
  data() {
    return {
      config,
      sidebarMenuList: MENU_ITEM_LIST
    };
  }
});
</script>

<style scoped lang="scss"></style>
