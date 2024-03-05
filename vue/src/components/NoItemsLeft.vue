<template>
  <div
      class="mt-3 font-medium text-red-500 text-center flex  bg-red-500 bg-opacity-10 rounded-md py-2 justify-center">
    <p class="w-max mx-auto">Нет данных</p>
  </div>
</template>

<script>
export default {
  name: "NoItemsLeft",
  props: {
    text: {
      type: String
    }
  },
};
</script>
