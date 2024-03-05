<template>
    <div class="flex justify-between">
        <h1 class="font-medium text-xl mb-4  lg:mb-6 dark:text-darkText">
            Создание поста
        </h1>
        <div class="flex gap-3">
            <router-link
                :to="{name: 'MainPage'}"
                class="align-middle bg-secondaryColor no-underline text-white px-3 py-4 rounded-xl">Главная
            </router-link>
        </div>
    </div>
    <form
        class="mt-4 flex flex-wrap justify-between"
        @submit.prevent="createNewPost">
        <div class="mb-2 w-full lg:w-half">
            <span class="mb-1 text-lg font-bold">
            Наименование поста
        </span>
            <input
                v-model="form.title"
                class="input-bordered input border w-full px-4 mt-2 py-2 rounded-md text-sm dark:bg-darkInp dark:border-0 dark:text-darkText"
                placeholder="Введите наименование поста"
                type="text"
            />
        </div>
        <div class="mb-2 w-full lg:w-half">
            <span class="mb-1 text-lg font-bold">
            Описание поста
        </span>
            <input
                v-model="form.body"
                class="input-bordered input border w-full px-4 mt-2 py-2 rounded-md text-sm dark:bg-darkInp dark:border-0 dark:text-darkText"
                placeholder="Введите описание поста"
                type="text"
            />
        </div>
        <div>
            <button
                v-if="loading === false"
                class="w-max px-6 py-2.5 rounded-md text-center bg-secondaryColor dark:bg-secondaryColor text-white cursor-pointer"
                type="submit">
                Сохранить
            </button>
            <div
                v-else
                class="w-max px-6 py-2.5 rounded-md text-center bg-secondaryColor dark:bg-secondaryColor text-white cursor-pointer flex items-center">
                <p class="spinner mr-2"></p>
                Подождите
            </div>
        </div>
    </form>

</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "CreatePage",
    data() {
        return {
            loading: false,
            form: {
                title: "",
                body: "",
            },
        };
    },
    methods: {
        ...mapActions(["createPost"]),
        async createNewPost() {
            this.loading = true;
            try {
                await this.createPost(this.form);
                this.loading = false;
                this.$router.push({name: "MainPage"});
            } catch (e) {
                this.loading = false;
                console.log(e);
            }
        },
    },
}
</script>

<style scoped>

</style>
