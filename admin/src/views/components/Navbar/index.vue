<template>
  <b-navbar variant="dark" type="dark" sticky class="flex-md-nowrap p-0 shadow">
    <b-navbar-brand
      class="custom-navbar-brand col-md-3 col-lg-2 mr-0 px-3"
      href="#"
    >
      Company name
    </b-navbar-brand>
    <button
      class="navbar-toggler position-absolute d-md-none collapsed"
      type="button"
      data-toggle="collapse"
      data-target="#sidebarMenu"
      aria-controls="sidebarMenu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <input
      class="form-control form-control-dark w-100"
      type="text"
      placeholder="Search"
      aria-label="Search"
    />
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </b-navbar>
</template>

<script>
// import Breadcrumb from '../breadcrumb/index';

function logout() {
  return new Promise(resolve => {
    setTimeout(resolve, 1000);
  });
}

export default {
  name: 'index',
  // components: { Breadcrumb },
  data() {
    return {
      show: false,
      items: [
        {
          text: 'Admin',
          href: '#'
        },
        {
          text: 'Manage',
          href: '#'
        },
        {
          text: 'Library',
          active: true
        }
      ]
    };
  },
  methods: {
    async logout() {
      await logout();
      // window.location = '/admin/login';
    }
  }
};
</script>

<style scoped>
.custom-navbar-brand {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, 0.25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.25);
}
</style>
