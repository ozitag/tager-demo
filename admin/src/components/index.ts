import Vue from 'vue';

import PageTitle from '@/components/PageTitle.vue';
import Layout from '@/components/Layout.vue';
import SvgIcon from '@/components/SvgIcon.vue';
import Button from '@/components/Button/index.vue';
import FormField from '@/components/FormField.vue';
import FormCheckboxField from '@/components/FormCheckboxField.vue';
import Input from '@/components/Input.vue';
import Checkbox from '@/components/Checkbox.vue';
import TextArea from '@/components/TextArea.vue';
import InputLabel from '@/components/InputLabel.vue';
import FormGroup from '@/components/FormGroup.vue';
import FormError from '@/components/FormError.vue';
import Table from '@/components/Table/index.vue';
import TableCell from '@/components/Table/components/Cell.vue';
import ImageInput from '@/components/ImageInput.vue';
import Spinner from '@/components/Spinner.vue';

export function registerComponents() {
  Vue.component('page-title', PageTitle);
  Vue.component('base-layout', Layout);
  Vue.component('base-button', Button);
  Vue.component('base-table', Table);
  Vue.component('base-table-cell', TableCell);
  Vue.component('svg-icon', SvgIcon);
  Vue.component('image-input', ImageInput);
  Vue.component('base-input', Input);
  Vue.component('base-checkbox', Checkbox);
  Vue.component('base-textarea', TextArea);
  Vue.component('base-label', InputLabel);
  Vue.component('base-form-group', FormGroup);
  Vue.component('base-form-error', FormError);
  Vue.component('base-form-field', FormField);
  Vue.component('base-form-checkbox', FormCheckboxField);
  Vue.component('spinner', Spinner);
}
