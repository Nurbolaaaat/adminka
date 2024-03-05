<template>
    <div class="flex justify-between">
        <h1 class="font-medium text-xl mb-4  lg:mb-6 dark:text-darkText">
            Главная
        </h1>
        <div class="flex gap-3">
            <router-link
                :to="{name: 'CreatePage'}"
                class="align-middle bg-green-500 no-underline text-white px-3 py-4 rounded-xl">Создать пост</router-link>
            <button class="bg-secondaryColor text-white px-3 py-1 rounded-xl" @click="handleLogOut">Выйти</button>
        </div>
    </div>
    <div v-if="postsData.data" class="mt-3">

            <TableComponent :columns="columns" :source="postsData" :pagination="postsData.meta">
                <template #default="{column, row}">
                    <template v-if="column.fname === 'name'">
                        {{ row.title }}
                    </template>
                    <template v-if="column.fname === 'author'">
                        {{ row.user.name }}
                    </template>
                    <template v-if="column.fname === 'body'">
                        {{ row.body.substring(0, 128) + '...' }}
                    </template>
                    <div v-if="row.user.id === getCurrentUser().data.id">
                        <template v-if="column.fname === 'actions'">
                            <div class="flex flex-col ">
                                <button
                                    class="text-white mt-2 p-2.5 bg-yellow-400 rounded-md"
                                    @click="updatePost(row.id)">
                                    Редактировать
                                </button>
                                <button
                                    class="text-white mt-2 p-2.5 bg-red-600 rounded-md"
                                    @click="deletePost(row.id)">
                                    Удалить
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </TableComponent>
    </div>
    <div v-else>
        <p>Загрузка....</p>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import TableComponent from "@/components/TableComponent.vue";
import axios from "@/utils/axios.js";

export default {
    name: "MainPage",
    components: {TableComponent},
    data() {
        return {
            editData: {},
            postsData: {},
            columns: [
                {
                    name: "Наименование поста",
                    fname: "name"
                },
                {
                    name: "Имя автора",
                    fname: "author"
                },
                {
                    name: "Описание",
                    fname: "body"
                },
                {
                    name: "Действия",
                    fname: "actions"
                }
            ]
        }
    },
    async mounted() {
        await this.getAllPostData();
        await this.currentUser();
        this.postsData = this.getAllPosts();
    },
    methods: {
        ...mapActions(["logoutUser", "getAllPostData", "updatePost", "currentUser"]),
        ...mapGetters(["getAllPosts", "getCurrentUser"]),
        handleLogOut() {
            this.logoutUser()
                .then(() => {
                    this.$router.go({name: "Auth"});
                })
        },
        deletePost(id) {
            axios.delete("/posts/" + id);
        },
        updatePost(id) {
            this.$router.push({name: "UpdatePage", params: {id: id}});
        }
    },
};
</script>
