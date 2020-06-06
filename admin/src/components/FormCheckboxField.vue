<template>
  <base-form-group>
    <base-checkbox
      v-bind:id="name"
      v-bind:name="name"
      v-bind:value="value"
      v-bind:checked="checked"
      v-on:change="$emit('change', $event)"
    />
    <base-label for-checkbox v-bind:for="name" v-if="Boolean(label)">
      {{ label }}
    </base-label>
  </base-form-group>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    name: {
      type: String,
      required: true
    },
    label: String,
    checked: Boolean,
    value: Boolean,
    error: String
  },
  model: {
    prop: 'checked',
    event: 'change'
  }
});
</script>

<style scoped lang="scss">
label {
  transition: box-shadow 0.15s ease-in-out;
}

input:focus + label,
input:active + label {
  border-radius: 3px;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>
