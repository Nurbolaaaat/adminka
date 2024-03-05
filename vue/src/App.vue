<template>
  <metainfo>

  </metainfo>
  <div class="h-full lg:overflow-y-auto">
    <DefaultLayout v-if="$route.name !== 'Auth' && $route.name !== 'PasswordRecovery'">
      <router-view></router-view>
    </DefaultLayout>
    <router-view v-else></router-view>
  </div>
</template>

<script>
import {useMeta} from "vue-meta";
import DefaultLayout from "@/layouts/DefaultLayout.vue";

export default {
  name: "App",
  components: {
    DefaultLayout,
  },
  setup() {
    useMeta({
      title: "Админка",
    });
  },
};
</script>
