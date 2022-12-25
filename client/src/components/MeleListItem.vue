<script lang="ts">
import { defineComponent } from "vue";
import type { PropType } from "vue";
import type { Category, Nutrient } from "@/types/types";

export default defineComponent({
  props: {
    data: {
      // provide more specific type to `Object`
      type: Object as PropType<Category | Nutrient>,
      required: true,
    },
  },
});
</script>

<template>
  <div>
    <li class="mele-list__item">{{ data.name }}</li>
    <slot></slot>
  </div>
</template>

<style lang="scss">
$c: ".mele-list__item";
#{$c} {
  align-items: center;
  background-color: var(--vt-c-indigo);
  border-bottom: 1px solid var(--vt-c-white);
  color: var(--vt-c-white);
  cursor: pointer;
  display: flex;
  height: 45px;
  padding: 0.5rem 1rem;

  .mele-list--inset & {
    background-color: var(--color-background);
    border-bottom: 1px solid var(--vt-c-indigo);
    color: var(--color-text);
  }
}
</style>
