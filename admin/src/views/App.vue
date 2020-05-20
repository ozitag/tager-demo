<template>
  <div>
    <sidebar></sidebar>
    <div class="page-container"></div>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar';
// import Navbar from './components/Navbar';

import { localStorageService } from '@/services/storage';

const SIDEBAR_COLLAPSED_KEY = 'sidebarCollapsed';

export default {
  name: 'App',
  components: { Sidebar },
  data() {
    return {
      onDragOver: false,
      sidebarCollapsed: false
    };
  },
  computed: {
    version() {
      return {
        date: !this.sidebarCollapsed ? '2020-04-08' : null,
        current: '0.5.3'
      };
    }
  },
  mounted() {
    this.sidebarCollapsed =
      localStorageService.get(SIDEBAR_COLLAPSED_KEY) === 'true';
  },
  methods: {
    toggleSidebar() {
      const newValue = !this.sidebarCollapsed;
      this.sidebarCollapsed = newValue;
      localStorageService.set(SIDEBAR_COLLAPSED_KEY, newValue);
    }
  }
};
</script>

<style scoped lang="scss">
.page-container {
  min-height: 100vh;
  transition: all 0.2s ease;

  @media screen and (max-width: 1439px) and (min-width: 992px) {
    padding-left: 70px;
  }

  @media screen and (max-width: 991px) {
    padding-left: 0;
  }
}
</style>
