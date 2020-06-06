<template>
  <input
    v-bind:value="value"
    v-on:input="$emit('input', $event.target.value)"
    v-on:change="$emit('change', $event.target.value)"
    v-bind:type="type"
  />
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'TextInput',
  props: {
    value: String,
    type: {
      type: String,
      default: 'text',
      validator(value: string): boolean {
        return ['text', 'number', 'email', 'password', 'date'].includes(value);
      }
    }
  },
  methods: {
    // emitWithLog(eventName: string, event: string) {
    //   console.log('Event: ', eventName, event);
    //   this.$emit(eventName, event);
    // }
    //   handleInput(event: Event) {
    //     const newValue = (event.target as HTMLInputElement).value;
    //
    //     const isValid =
    //       this.type !== 'number' ||
    //       (this.type === 'number' && !Number.isNaN(Number(newValue)));
    //
    //     console.log('isValid', [isValid, newValue, this.value]);
    //     this.$emit('input', isValid ? newValue : this.value);
    //   }
  }
});
</script>

<style scoped lang="scss">
input {
  display: block;
  width: 100%;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

  &:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }
}
</style>
