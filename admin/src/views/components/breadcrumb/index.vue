<template>
  <b-breadcrumb :items="items"></b-breadcrumb>
</template>

<script>
import Routes from '@/router/Sidebar';
export default {
  name: 'index',
  computed: {
    items() {
      const main = {
        text: 'Главная',
        to: { path: '/admin' }
      };
      let path = this.$route.path;
      let edit = false;

      if (this.$route.matched.length) {
        //ToDo Refactoring
        path = this.$route.matched[0].path.split('/:');
        if (path.length > 1) {
          edit = true;
        }
        path = path[0];
      }

      if (path.indexOf('/create') !== -1) {
        path = path.replace('/create', '');
      }

      let active = this.routes.filter(
        u =>
          u.path === path ||
          (u.children && u.children.find(c => c.path === path))
      );

      if (active.length > 0 && active[0].children) {
        let child = active[0].children.find(u => u.path === path);
        if (child) {
          active.push({
            name: child.name,
            path: child.path
          });
        }
      }

      if (this.$route.path.indexOf('/create') !== -1) {
        active.push({
          name: 'Создание'
        });
      }
      if (edit) {
        active.push({
          name: 'Редактирование'
        });
      }

      return [main].concat(
        active.map(function(u) {
          return {
            text: u.name,
            to: { path: u.path },
            disabled: u.children && !u.path ? true : false
          };
        })
      );
    }
  },
  created() {
    this.routes = Routes;
  },
  data() {
    return {
      routes: []
    };
  }
};
</script>

<style scoped>
.breadcrumb {
  margin-bottom: 0;
  background: none;
}
</style>
<style>
a.disabled,
a.disabled:hover {
  color: #6c757d;
  text-decoration: none;
}
</style>
