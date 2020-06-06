<template>
  <td>
    <a v-bind:href="value">{{ label }}</a>
  </td>
</template>

<script lang="ts">
import Vue from 'vue';

import { ColumnDefinition } from '@/components/Table/Table.types';

export default Vue.extend({
  props: {
    column: {
      type: Object as () => ColumnDefinition,
      required: true
    },
    row: {
      type: Object,
      required: true
    }
  },
  computed: {
    value(): string {
      if (this.column.getLinkHref) {
        return this.column.getLinkHref(this.row, this.column);
      }

      return this.row[this.column.field];
    },
    label(): string {
      if (this.column.getLinkLabel) {
        return this.column.getLinkLabel(this.row, this.column);
      }

      return this.value;
    }
  }
});
</script>

<style scoped lang="scss">
a {
  color: #007bff;

  &:hover {
    color: #0056b3;
    text-decoration: underline;
  }
}
</style>
