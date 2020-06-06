<template>
  <button
    v-bind:class="['button', variant, { loading: loading }]"
    v-bind:type="type"
    v-on:click="$emit('click', $event)"
    v-bind:disabled="disabled || loading"
  >
    <span class="spinner-wrapper" v-if="loading">
      <spinner class="button-spinner" size="28" />
    </span>

    <slot>Submit</slot>
  </button>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    variant: {
      type: String,
      validator(value: string): boolean {
        return ['outline-primary', 'outline-secondary', 'icon'].includes(value);
      }
    },
    type: {
      type: String,
      default: 'button'
    },
    disabled: Boolean,
    loading: Boolean
  }
});
</script>

<style scoped lang="scss">
.button {
  position: relative;
  display: inline-block;
  font-weight: 400;
  color: #212529;
  text-align: center;
  vertical-align: middle;
  user-select: none;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  cursor: pointer;

  &:disabled {
    cursor: not-allowed;
  }

  &.loading {
    color: transparent;
    cursor: wait;
  }
}

.spinner-wrapper {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: white;
  border-radius: 0.25rem;

  display: flex;
  align-items: center;
  justify-content: center;

  .button-spinner {
    display: block;
  }
}

.outline-primary {
  color: var(--primary);
  border-color: var(--primary);

  &:hover {
    background-color: var(--primary);
    color: white;
  }
}

.outline-secondary {
  color: var(--secondary);
  border-color: var(--secondary);

  .button-spinner {
    color: var(--secondary);
  }

  &:not(:disabled):hover,
  &:not(:disabled):active {
    background-color: var(--secondary);
    color: white;

    .button-spinner {
      color: white;
    }
  }

  &:focus {
    box-shadow: 0 0 0 0.2rem rgba(11, 37, 37, 0.4);
  }
}

.icon {
  padding: 0.375rem;
  border-radius: 50%;
  color: var(--secondary);

  svg {
    display: block;
    fill: currentColor;
    transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
  }

  &:not(:disabled):hover {
    background-color: rgba(0, 0, 0, 0.1);
  }

  &:disabled {
    background-color: rgba(0, 0, 0, 0.08);
  }
}
</style>
