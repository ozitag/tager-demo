<template>
  <navigation-grid :nav-items="navItemList" />
</template>

<script lang="ts">
import { defineComponent, ref } from '@vue/composition-api';
import { NavigationGridItem } from '@tager/admin-ui';

export default defineComponent({
  name: 'Home',
  setup() {
    const navItemList = ref<Array<NavigationGridItem>>([]);

    return {
      navItemList,
    };
  },
});
</script>

<style scoped></style>
