<template>
  <input
    v-bind:checked="checked"
    v-on:change="$emit('change', $event.target.checked)"
    type="checkbox"
  />
</template>

<script>
export default {
  name: 'Checkbox',
  props: {
    checked: Boolean
  },
  model: {
    prop: 'checked',
    event: 'change'
  }
};
</script>

<style scoped lang="scss">
input {
  position: absolute;
  margin-top: 0.3rem;
  -webkit-appearance: checkbox;
}
</style>
