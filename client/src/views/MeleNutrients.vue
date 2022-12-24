<script lang="ts">
import { defineComponent } from "vue";
import type { PropType } from "vue";
import type { Category } from "@/types/types";

export default defineComponent({
  props: {
    data: {
      // provide more specific type to `Object`
      type: Object as PropType<Array<Category>>,
      required: true,
    },
  },
});
</script>

<template>
  <div>
    <h1>Nutrients</h1>
    <ul>
      <li v-for="nutrient in data" :key="nutrient.name">{{ nutrient.name }}</li>
    </ul>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
