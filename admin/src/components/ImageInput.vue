<template>
  <div>
    <div
      v-if="shouldDisplayDropbox"
      ref="dropbox"
      v-bind:class="['drop-zone', isDragOver ? 'highlight' : null]"
      v-on:dragenter="handleDragEnter"
      v-on:dragover="handleDragOver"
      v-on:drop="handleDrop"
      v-on:dragleave="handleDragLeave"
    >
      <div class="upload-message-container">
        <svg-icon name="upload" />
        <p>Drag and drop a file here or click</p>
      </div>

      <label class="file-input-label">
        <input
          type="file"
          class="visually-hidden"
          accept="image/*"
          ref="fileInput"
          v-bind:multiple="multiple"
          v-on:change="handleChange"
        />
      </label>
    </div>

    <div class="image-grid">
      <div
        class="image-container"
        v-for="image of images"
        v-bind:key="image.id"
      >
        <base-button
          class="clear-button"
          variant="icon"
          title="Clear"
          v-on:click="clearImage(image.id)"
        >
          <svg-icon name="clear" />
        </base-button>
        <img v-bind:src="image.url" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { api } from '@tager/admin-core';
import { FileUploadScenario, ImageType } from '@/typings/model';
import { notEmpty } from '@/utils/common';

function isImageObject(image: any) {
  return (
    typeof image === 'object' &&
    typeof image?.id === 'number' &&
    typeof image?.url === 'string'
  );
}

export default Vue.extend({
  name: 'ImageInput',
  model: {
    prop: 'value',
    event: 'change'
  },
  props: {
    value: {
      required: true,
      validator(value: any): boolean {
        return Array.isArray(value)
          ? value.every(isImageObject)
          : isImageObject(value) || value === null;
      }
    },
    multiple: Boolean,
    maxFileCount: Number,
    /** kilobytes */
    maxFileSize: Number,
    scenario: {
      type: String as () => FileUploadScenario,
      default: 'default',
      validator(value: string): boolean {
        return ['product', 'product-preset', 'default'].includes(value);
      }
    }
  },
  watch: {
    $props: {
      immediate: true,
      handler(): void {
        if (this.multiple) {
          if (!Array.isArray(this.value) || !this.value.every(isImageObject)) {
            const message = JSON.stringify(
              {
                message: 'ImageInput: value should be Array<ImageType>',
                value: this.value,
                multiple: this.multiple
              },
              null,
              4
            );
            console.error(message);
          }
        } else {
          if (!isImageObject(this.value) && this.value !== null) {
            const message = JSON.stringify(
              {
                message: 'ImageInput: value should be ImageType or null',
                value: this.value,
                multiple: this.multiple
              },
              null,
              4
            );
            console.error(message);
          }
        }
      }
    }
  },
  data() {
    return {
      isDragOver: false
    };
  },
  computed: {
    images(): Array<ImageType> {
      if (this.multiple) {
        return this.value as Array<ImageType>;
      } else {
        return [this.value].filter(Boolean) as Array<ImageType>;
      }
    },
    shouldDisplayDropbox(): boolean {
      if (this.multiple && typeof this.maxFileCount === 'number') {
        return this.images.length < this.maxFileCount;
      }

      if (!this.multiple) {
        return this.images.length === 0;
      }

      return true;
    }
  },
  methods: {
    handleChange(event: Event) {
      this.handleFiles((event.target as HTMLInputElement).files);
    },
    highlightDropArea() {
      this.isDragOver = true;
    },
    unhighlightDropArea() {
      this.isDragOver = false;
    },
    handleFiles(fileList: FileList | null): void {
      const fileArray = fileList ? [...fileList] : [];
      console.log('Files: ', fileArray);

      Promise.all(
        fileArray.map(file => {
          return api
            .uploadFile<ImageType>({
              file,
              scenario: this.scenario as FileUploadScenario
            })
            .then(response => {
              console.log('response', response);
              return response;
            })
            .catch(error => {
              console.error(error);
              return null;
            });
        })
      )
        .then(images => {
          const newImages = [...this.images, ...images].filter(notEmpty);

          this.emitChangeEvent(newImages);
        })
        .catch(error => {
          console.error(error);

          /** Clear value of file input */
          if (this.$refs.fileInput) {
            (this.$refs.fileInput as HTMLInputElement).value = '';
          }
        });
    },
    handleDragEnter(event: DragEvent) {
      event.stopPropagation();
      event.preventDefault();

      this.highlightDropArea();
    },
    handleDragOver(event: DragEvent) {
      event.stopPropagation();
      event.preventDefault();
      if (event.dataTransfer) {
        event.dataTransfer.dropEffect = 'move';
      }

      this.highlightDropArea();
    },
    handleDragLeave(event: DragEvent) {
      event.stopPropagation();
      event.preventDefault();

      this.unhighlightDropArea();
    },
    handleDrop(event: DragEvent) {
      event.stopPropagation();
      event.preventDefault();

      this.unhighlightDropArea();

      const dataTransfer = event.dataTransfer;

      this.handleFiles(dataTransfer?.files ?? null);
    },
    clearImage(imageId: number): void {
      const newImages = this.images.filter(image => image.id !== imageId);
      this.emitChangeEvent(newImages);
    },
    emitChangeEvent(newImages: Array<ImageType>): void {
      const newValue = this.multiple ? newImages : newImages[0];

      console.log('emit change', newValue);
      this.$emit('change', newValue);
    }
  }
});
</script>

<style scoped lang="scss">
.drop-zone {
  position: relative;
  height: 250px;
  max-height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 5px 10px;
  border-radius: 3px;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  transition: background-color 0.15s linear;

  &:hover {
    background-color: rgba(62, 69, 81, 0.05);
  }

  &.highlight {
    background-color: rgba(62, 69, 81, 0.05);
  }
}

.upload-message-container {
  display: flex;
  flex-direction: column;
  align-items: center;

  svg {
    display: block;
    width: 60px;
    height: auto;
    fill: #bbb;
  }

  p {
    color: #bbb;
  }
}

.file-input-label {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  cursor: pointer;
}

.visually-hidden {
  position: absolute !important;
  height: 1px;
  width: 1px;
  overflow: hidden;
  clip: rect(1px, 1px, 1px, 1px);
}

.image-grid {
}

.image-container {
  display: inline-block;
  position: relative;
  margin: 20px;
  /*width: 250px;*/

  .clear-button {
    position: absolute;
    right: 0;
    top: 0;
    transform: translate(50%, -50%);
    background-color: #f9fafb;
    transition: transform 0.1s ease-in-out;
    border: 1px solid #ddd;

    &:hover {
      transform: translate(50%, -50%) scale(1.1);
      box-shadow: 0px 3px 2px -1px rgba(0, 0, 0, 0.2),
        0px 1px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
    }
  }

  img {
    max-height: 250px;
    vertical-align: middle;

    /*width: 100%;*/
    /*height: 100%;*/
    /*object-fit: contain;*/
  }
}
</style>
