<template>
  <div class="container">
    <div class="top">
      <slot name="top"></slot>
    </div>
    <div class="content">
      <slot name="content"></slot>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'Layout'
});
</script>

<style scoped lang="scss">
.container {
  width: 100%;
  padding: 0 15px;
}

.top {
  margin-bottom: 2rem;
  margin-top: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.content {
  background-color: white;
  border-radius: 3px;
  border: 1px solid rgba(0, 0, 0, 0.0625);
  padding: 20px;
}
</style>
