<template>
  <td>{{ value }}</td>
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
      const value = this.row[this.column.field];

      return this.column.format
        ? this.column.format(value, this.row, this.column)
        : value;
    }
  }
});
</script>

<style scoped lang="scss"></style>
