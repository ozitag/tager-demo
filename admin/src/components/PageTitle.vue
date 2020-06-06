<template>
  <h4 class="page-title"><slot></slot></h4>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'PageTitle'
});
</script>

<style scoped lang="scss">
h4 {
  color: var(--secondary);
  letter-spacing: 0.5px;
  font-size: 1.3rem;
  font-weight: 600;
}
</style>
