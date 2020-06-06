<template>
  <td>{{ value }}</td>
</template>

<script lang="ts">
import Vue from 'vue';

import { ColumnDefinition } from '@/components/Table/Table.types';
import { formatDate } from '@/utils/format';

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
    value() {
      return formatDate(new Date(this.row[this.column.field]));
    }
  }
});
</script>

<style scoped lang="scss"></style>
