<template>
  <small><slot></slot></small>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'FormError'
});
</script>

<style scoped lang="scss">
small {
  font-size: 80%;
  font-weight: 400;
  display: block;
  margin-top: 0.25rem;
  color: red;
}
</style>
