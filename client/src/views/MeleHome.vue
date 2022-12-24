<script setup lang="ts">
import type { Category } from "@/types/types";
import { ref } from "vue";
import MeleNutrients from "./MeleNutrients.vue";
const data = ref<Category[]>();
const error = ref(null);

fetch("http://localhost/api/categories")
  .then((res) => res.json())
  .then((json) => {
    data.value = json.data;
    console.log(json);
  })
  .catch((err) => (error.value = err));
</script>

<template>
  <main>
    <MeleNutrients v-if="data" :data="data" />
  </main>
</template>
