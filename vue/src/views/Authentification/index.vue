<template>
  <div
      class="flex flex-col lg:flex-row w-full items-center h-screen justify-between"
  >
    <div
        class="w-full h-full pb-10 lg:pb-0 flex justify-center dark:bg-darkElBg dark:text-white items-center px-4 lg:px-16 pt-10 lg:pt-0"
    >
      <div>
        <h1 class=" text-xl mb-4">
          Добро пожаловать в Админку ТЗ !👋🏻
        </h1>
        <form action="" @submit.prevent="sendForm">
          <div class="mb-4">
            <p class="mb-1 ">Электронная почта</p>
            <input
                v-model="loginForm.email"
                :class="{'border-red-500': v$.loginForm.email.$errors.length}"
                class="rounded-md text-black border py-2 px-4 w-full"
                placeholder="email@gmail.com"
                tabindex="1"
                type="email"
            />
          </div>
          <div class="mb-4">
            <div class="flex justify-between mb-1 ">
              <p>Пароль</p>
            </div>
            <div class="relative">
              <input
                  v-model="loginForm.password"
                  :class="{'border-red-500': v$.loginForm.password.$errors.length}"
                  :type="passwordField"
                  class="rounded-md text-black border py-2 px-4 w-full"
                  placeholder="●●●●●●●●●●"
                  tabindex="2"
              />
              <font-awesome-icon
                  v-if="passwordField === 'password'"
                  :icon="['fas', 'eye']"
                  class="absolute right-4 -translate-y-1/2 top-1/2 cursor-pointer"
                  @click.stop="switchVisibilityPassword"
              />
              <font-awesome-icon
                  v-else
                  :icon="['fas', 'eye-slash']"
                  class="absolute right-4 -translate-y-1/2 top-1/2 cursor-pointer"
                  @click.stop="switchVisibilityPassword"
              />
            </div>
          </div>
          <button
              class="text-center bg-secondaryColor text-white w-full rounded-md py-3"
              tabindex="4"
              type="submit"
          >
            Войти
          </button>
        </form>
        <div  class="text-center bg-secondaryColor text-white w-full rounded-md py-3 mt-4">
            <router-link
                :to="{name: 'RegistrationPage'}"
                class="text-white no-underline"
               >
                Зарегистрироваться
            </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import {inject} from "vue";
import {useVuelidate} from "@vuelidate/core";
import {useMeta} from "vue-meta";
import {required} from "@vuelidate/validators";

export default {
  name: 'AuthPage',
  setup() {
    useMeta({title: 'Авторизация'});
    const toast = inject('notify');
    return {
      v$: useVuelidate(), toast
    };
  },
  data() {
    return {
        isRegisterFalse: false,
      loginForm: {
        email: '',
        password: '',
      },
      rememberMe: false,
      passwordField: 'password',
    };
  },
  validations() {
    return {
      loginForm: {
        email: {required},
        password: {required}
      },
    };
  },
  computed: {
    ...mapGetters(["getAuth", "getUser"]),
  },
  methods: {
    ...mapActions(["authUser", "setUser", "currentUser"]),
    async sendForm() {
      this.v$.$validate()

      if (this.v$.$invalid) {
        this.toast(false, "Не все поля заполнены")
        return
      }

      await this.authUser(this.loginForm)

      if (!this.getAuth.status) {
        this.toast(true, "Авторизация успешна")
        await this.setUser()
        await this.currentUser()
        this.$router.go({name: 'MainPage'})
      } else {
        this.toast(false, "Данные неверны")
      }
    },
    switchVisibilityPassword() {
      this.passwordField = this.passwordField === "password" ? "text" : "password"
    },
    goToRegistration() {

      this.$router.push({name: 'RegistrationPage'})
    }
  }
}
</script>
