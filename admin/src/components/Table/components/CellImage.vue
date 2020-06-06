<template>
  <td>
    <div class="cell-inner">
      <div class="image-wrapper"><img v-bind:src="value" alt="Photo" /></div>
    </div>
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
      return this.row[this.column.field];
    }
  }
});
</script>

<style scoped lang="scss">
td {
  padding: 0;
  text-align: center;
}

.cell-inner {
  display: flex;
  justify-content: center;
}

.image-wrapper {
  width: 100px;
  height: 100px;
}
img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
