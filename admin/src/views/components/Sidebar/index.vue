<template>
  <div class="sidebar">
    <div class="sidebar-inner">
      <div class="sidebar-top">
        <div class="sidebar-top-inner">
          <div class="logo-container">
            <img class="logo" src="" alt="" />
          </div>
        </div>
      </div>
      <ul class="menu-list">
        <li
          class="menu-item"
          v-for="menuItem in menuItemList"
          v-bind:key="menuItem.id"
        >
          <a class="menu-link" v-bind:href="menuItem.path">
            <span class="icon-container">
              <home-icon />
            </span>
            <span class="menu-link-name">{{ menuItem.name }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import HomeIcon from '@/assets/svg/home.svg';

import { MENU_ITEM_LIST } from './Sidebar.constants';

export default {
  name: 'index',
  components: { HomeIcon },
  data() {
    return {
      menuItemList: MENU_ITEM_LIST
    };
  },
  computed: {
    path() {
      return '/admin/sliders';
    }
  },
  methods: {
    toggleSidebar() {
      this.$emit('toggle');
    }
  }
};
</script>

<style scoped lang="scss">
.sidebar {
  background-color: #fff;
  bottom: 0;
  overflow: hidden;
  position: fixed;
  top: 0;
  transition: all 0.2s ease;
  width: 280px;
  z-index: 1000;

  @media screen and (max-width: 1439px) and (min-width: 992px) {
    width: 70px;
  }

  @media screen and (max-width: 991px) {
    left: -280px;
    width: 250px;
  }
}

.sidebar-inner {
  position: relative;
  height: 100%;
}

.sidebar-top {
  border-bottom: 1px solid rgba(0, 0, 0, 0.0625);
  border-right: 1px solid rgba(0, 0, 0, 0.0625);
  line-height: 0;
  padding: 0 20px;
  transition: all 0.2s ease;

  height: 65px;

  @media screen and (max-width: 1439px) and (min-width: 992px) {
    border-bottom: 1px solid transparent;
    padding: 0;
  }
}

.sidebar-top-inner {
  display: flex;
  align-items: center;
}

.logo-container {
  min-height: 64px;
  width: 70px;
}

.logo {
  vertical-align: middle;
}

.menu-list {
  list-style-type: none;
  border-right: 1px solid rgba(0, 0, 0, 0.0625);
  height: calc(100vh - 65px);
  padding: 30px 0 0;
}

.menu-item {
}

.menu-link {
  display: block;
  font-size: 15px;
  font-weight: 500;
  color: #72777a;
  padding: 5px 15px;
  position: relative;
  white-space: nowrap;
  transition: all 0.3s ease;

  &:hover {
    color: #313435;
    text-decoration: none;
  }
}

.menu-link-name {
  @media screen and (max-width: 1439px) and (min-width: 992px) {
    display: none;
  }
}

.icon-container {
  border-radius: 6px;
  display: inline-block;
  font-size: 17px;
  height: 35px;
  left: 0;
  line-height: 35px;
  margin-right: 14px;
  position: relative;
  text-align: center;
  transition: all 0.3s ease;
  width: 35px;
}
</style>
