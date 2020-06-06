<template>
  <label v-bind:class="mainClass"><slot></slot></label>
</template>

<script>
export default {
  name: 'InputLabel',
  props: {
    forCheckbox: {
      type: Boolean
    }
  },
  data: function() {
    return {
      mainClass: this.forCheckbox ? 'checkbox-label' : ''
    };
  }
};
</script>

<style scoped lang="scss">
label {
  display: inline-block;
  margin-bottom: 0.5rem;
}

.checkbox-label {
  margin-bottom: 0;
  user-select: none;
  padding-left: 1.25rem;
}
</style>
