<template>
  <component v-bind:is="iconComponent"></component>
</template>

<script lang="ts">
import Vue, { Component } from 'vue';

import HomeIcon from '@/assets/svg/home.svg';
import GroupIcon from '@/assets/svg/group.svg';
import ViewListIcon from '@/assets/svg/view_list.svg';
import ExpandLessIcon from '@/assets/svg/expand_less.svg';
import ExpandMoreIcon from '@/assets/svg/expand_more.svg';
import EditIcon from '@/assets/svg/edit.svg';
import DeleteIcon from '@/assets/svg/delete.svg';
import CloudUploadIcon from '@/assets/svg/cloud_upload.svg';
import CloseIcon from '@/assets/svg/close.svg';
import MenuIcon from '@/assets/svg/menu.svg';
import SettingsIcon from '@/assets/svg/settings.svg';
import AssignmentIcon from '@/assets/svg/assignment.svg';
import ChevronRightIcon from '@/assets/svg/chevron_right.svg';

const ICON_MAP: { [iconName: string]: Component } = {
  home: HomeIcon,
  group: GroupIcon,
  viewList: ViewListIcon,
  expandLess: ExpandLessIcon,
  expandMore: ExpandMoreIcon,
  edit: EditIcon,
  delete: DeleteIcon,
  upload: CloudUploadIcon,
  clear: CloseIcon,
  close: CloseIcon,
  menu: MenuIcon,
  settings: SettingsIcon,
  assignment: AssignmentIcon,
  chevronRight: ChevronRightIcon
};

export default Vue.extend({
  name: 'SvgIcon',
  props: {
    name: {
      type: String,
      validator(value: string): boolean {
        return Object.keys(ICON_MAP).includes(value);
      },
      required: true
    }
  },
  data() {
    return {
      iconComponent: ICON_MAP[this.name]
    };
  }
});
</script>

<style scoped></style>
