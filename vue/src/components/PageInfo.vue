<template>
  <p class="dark:text-darkText text-sm">
    Показывается от {{ pagesData.from }} до {{ pagesData.to }} записей из
    {{ pagesData.total }}
  </p>
</template>

<script>
export default {
  name: "PageInfo",
  props: {
    pagesData: {
      type: Object,
      required: false,
    },
  },
};
</script>
