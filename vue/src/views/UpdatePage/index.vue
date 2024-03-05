<template>
    <div class="flex justify-between">
        <h1 class="font-medium text-xl mb-4  lg:mb-6 dark:text-darkText">
            Редактирование поста - <b>{{ form.title }}</b>
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
        @submit.prevent="update">
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
                Обновить
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
import {mapActions, mapGetters} from "vuex";
import {inject} from "vue";

export default {
    name: "UpdatePage",
    setup () {
        const toast = inject('notify');
        return {
            toast
        }
    },
    data() {
        return {
            form: {
                title: "",
                body: "",
            },
            loading: false
        };
    },
    async mounted() {
        await this.detailPost(this.$route.params.id);
        this.setInitial();
    },
    methods: {
        ...mapActions(["detailPost", "updatePost"]),
        ...mapGetters(["getDetailPost"]),
        setInitial() {
            this.form = this.getDetailPost();
        },
        async update() {
            this.loading = true;
            try {
                await this.updatePost({
                    id: this.$route.params.id,
                    form: {
                        body: this.form.body,
                        title: this.form.title
                    }
                })
                this.toast(true, "Пост успешно обновлен")
                this.loading = false;
                this.$router.push({name: "MainPage"});
            } catch (e) {
                this.loading = false;
                console.log(e);
            }
        }
    }
}
</script>

<style scoped>

</style>
<!---->
