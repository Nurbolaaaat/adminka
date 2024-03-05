<template>
  <div class="flex w-full py-6 px-4 lg:px-0">
    <div class="lg:w-max h-full sticky top-0 z-[10000] lg:z-10">
    </div>
    <div v-if="$route.meta" class="w-full">
      <div class="container mx-auto">
        <slot/>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "DefaultLayout",
  data() {
    return {
      barState: localStorage.getItem("sidebar"),
    };
  },
  computed: {
    ...mapGetters(["getSidebar"]),
  },
};
</script>

<style scoped>

</style>
