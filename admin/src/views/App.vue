<template>
  <page-layout :sidebar-menu-list="sidebarMenuList">
    <router-view />
  </page-layout>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api';

import { MENU_ITEM_LIST } from '@/config/sidebarMenu';

export default defineComponent({
  name: 'App',
  setup() {
    return {
      sidebarMenuList: MENU_ITEM_LIST,
    };
  },
});
</script>

<style scoped lang="scss"></style>
