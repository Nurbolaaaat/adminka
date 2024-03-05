<template>
    <div class="flex justify-between">
        <h1 class="font-medium text-xl mb-4  lg:mb-6 dark:text-darkText">
            Регистрация
        </h1>
    </div>
    <form
        class="mt-4 flex flex-wrap justify-between"
        @submit.prevent="signUp">
        <div>
            <div class="mb-2 w-full lg:w-half">
            <span class="mb-1 text-lg font-bold">
            Имя
        </span>
                <input
                    v-model="form.name"
                    class="input-bordered input border w-full px-4 mt-2 py-2 rounded-md text-sm dark:bg-darkInp dark:border-0 dark:text-darkText"
                    placeholder="Введите ваше имя"
                    type="text"
                />
            </div>
            <div class="mb-2 w-full lg:w-half">
            <span class="mb-1 text-lg font-bold">
            Электронная почта
        </span>
                <input
                    v-model="form.email"
                    class="input-bordered input border w-full px-4 mt-2 py-2 rounded-md text-sm dark:bg-darkInp dark:border-0 dark:text-darkText"
                    placeholder="Введите ваш email"
                    type="text"
                />
            </div>
            <div class="mb-2 w-full lg:w-half">
            <span class="mb-1 text-lg font-bold">
            Пароль
            </span>
                <input
                    v-model="form.password"
                    class="input-bordered input border w-full px-4 mt-2 py-2 rounded-md text-sm dark:bg-darkInp dark:border-0 dark:text-darkText"
                    placeholder="*******"
                    type="password"
                />
            </div>
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
import {inject} from "vue";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";

export default {
    name: "RegistrationPage",
    setup () {
        const toast = inject('notify');
        return {
            v$: useVuelidate(), toast
        }
    },
    data() {
        return {
            loading: false,
            form: {
                name: "",
                email: "",
                password: ""
            }
        }
    },
    validations() {
        return {
            form: {
                name: {required},
                email: {required},
                password: {required}
            },
        };
    },
    methods: {
        ...mapActions([
            'register'
        ]),
        async signUp() {
            this.v$.$validate()

            if (this.v$.$invalid) {
                this.toast(false, "Не все поля заполнены")
                return
            }

            await this.register({
                email: this.form.email,
                name: this.form.name,
                password: this.form.password
            })
            this.toast(true, 'Успешно зарегались !')
            this.$router.push('/auth')
        }
    }
}
</script>

<style scoped>

</style>
