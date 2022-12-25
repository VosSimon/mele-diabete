<script lang="ts">
import { defineComponent } from "vue";
import type { PropType } from "vue";
import type { Category, Maybe } from "@/types/types";
import MeleListItem from "@/components/MeleListItem.vue";

export default defineComponent({
  props: {
    data: {
      type: Object as PropType<Array<Category>>,
      required: true,
    },
  },
  data() {
    return {
      showingCategory: null as Maybe<number>,
    };
  },
  components: { MeleListItem },
});
</script>

<template>
  <div>
    <h1>Nutrients</h1>
    <ul class="mele-list">
      <MeleListItem
        @click="
          showingCategory = showingCategory === catIndex ? null : catIndex
        "
        v-for="(category, catIndex) in data"
        :key="`category-${catIndex}`"
        :data="category"
      >
        <Transition name="roll-out" mode="out-in">
          <ul
            v-if="category.nutrients && showingCategory === catIndex"
            class="mele-list mele-list--inset"
          >
            <MeleListItem
              v-for="(nutrient, nutIndex) in category.nutrients"
              :key="`nutrient-${nutIndex}`"
              :data="nutrient"
            />
          </ul>
        </Transition>
      </MeleListItem>
    </ul>
  </div>
</template>

<style lang="scss">
$list: ".mele-list";
#{$list} {
  list-style: none;
  margin-left: 0;
  padding-left: 0;

  &--inset {
    max-height: calc(10 * 45) + px;
    overflow-y: auto;
    padding-left: 1rem;
  }
}

@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}

.roll-out-enter-active {
  transition: all 0.5s ease-out;
}

.roll-out-leave-active {
  transition: all 0.5s ease-in;
}

.roll-out-enter-from,
.roll-out-leave-to {
  max-height: 0px;
}
</style>
