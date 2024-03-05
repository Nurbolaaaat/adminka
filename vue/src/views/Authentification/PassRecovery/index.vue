<template>
  <div
      class="flex flex-col lg:flex-row w-full items-center h-screen justify-between"
  >
    <div
        class="w-full relative lg:w-2/3 bg-[#F8F8F8] dark:bg-darkInp h-full flex items-center pt-5 lg:pt-0"
    >
      <img
          alt=""
          class="absolute left-5 lg:left-11 top-5 lg:top-9 w-20 h-auto"
          src="../../../assets/img/logo.png"
      />
      <img
          alt=""
          class="w-1/2 mx-auto"
          src="../../../assets/img/authentication/passRecovery.png"
      />
    </div>
    <div
        class="w-full lg:w-1/3 dark:bg-darkElBg pb-10 lg:pb-0 h-full dark:text-white flex justify-center items-center px-4 lg:px-16 pt-10 lg:pt-0"
    >
      <div>
        <h1 class=" text-xl mb-4">
          {{ $t("passRecovery.head") }}? 🔑
        </h1>
        <p class="mb-6 ">
          {{ $t("passRecovery.description") }}
        </p>
        <form action="" class="mb-4" @submit.prevent="sendRecoveryLink">
          <div class="mb-4">
            <p class="mb-1 ">{{ $t("general.email") }}</p>
            <input
                v-model="loginForm.email"
                :class="{
              'border-red-500':
                v$.loginForm.email.$error
            }"
                class="rounded-md text-black border py-2 px-4 w-full"
                placeholder="email@gmail.com"
            />
          </div>
          <button
              class="text-center bg-secondaryColor text-white w-full rounded-md py-3"
              type="submit"
          >
            {{ $t("passRecovery.button") }}
          </button>
        </form>
        <div>
          <router-link class="flex items-center justify-center" to="/auth">
            <font-awesome-icon :icon="['fas', 'chevron-left']" class="mr-2"/>
            <p class="">{{ $t("general.goBack") }}</p>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useMeta} from "vue-meta";
import {mapActions, mapGetters} from "vuex";
import {inject} from "vue";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";

export default {
  name: "PassRecoveryPage",
  setup() {
    useMeta({title: "Авторизация"});
    const toast = inject('notify');
    return {v$: useVuelidate(), toast};
  },
  data() {
    return {
      loginForm: {
        email: "",
      },
    };
  },
  validations() {
    return {
      loginForm: {
        email: {required}
      }
    }
  },
  computed: {
    ...mapGetters(["getPassRecovery"]),
  },
  methods: {
    ...mapActions(["passRecovery"]),
    async sendRecoveryLink() {
      this.loading = true
      this.v$.$validate();

      if (this.v$.$invalid) {
        this.loading = false;
        this.toast(false, "Не все поля заполнены");
        return;
      }

      await this.passRecovery(this.loginForm)
          .then(() => {
            this.loading = false;
            this.toast(true, "На ваш email отправлена ссылка для восстановления пароля");
          })
          .catch((error) => {
            if (error.response.data.errors) {
              if (Object.keys(error.response.data.errors).length > 0) {
                Object.values(error.response.data.errors).forEach((err) => {
                  this.toast(false, this.$t(err[0]))
                })
              }
            } else {
              this.toast(false, this.$t(error.response.data.message))
            }
          }).finally(() => {
            this.loading = false;
          })
    },
  },
};
</script>