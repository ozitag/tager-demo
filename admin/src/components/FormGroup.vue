<template>
  <div class="form-group"><slot></slot></div>
</template>

<script>
export default {
  name: 'FormGroup'
};
</script>

<style scoped>
.form-group {
  position: relative;
  display: block;
  margin-bottom: 1rem;
}
</style>
