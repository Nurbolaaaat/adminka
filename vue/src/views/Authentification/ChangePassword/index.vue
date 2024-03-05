<template>
  <div
      class="flex flex-col lg:flex-row w-full items-center h-screen justify-between"
  >
    <div
        class="w-full relative lg:w-2/3 bg-[#F8F8F8] dark:bg-darkInp h-full lg:flex items-center pt-5 lg:pt-0"
    >
      <img
          alt=""
          class="absolute left-5 lg:left-11 top-5 lg:top-9 w-20 h-auto"
          src="../../../assets/img/logo.png"
      />
      <img
          alt=""
          class="w-1/2 mx-auto"
          src="../../../assets/img/authentication/changePass.png"
      />
    </div>
    <div
        class="w-full lg:w-1/3 dark:bg-darkElBg dark:text-white h-full flex justify-center items-center px-4 lg:px-16 pt-10 lg:pt-0 pb-10 lg:pb-0"
    >
      <div>
        <h1 class=" text-xl mb-4">
          {{ $t("changePassword.head") }} 🔐
        </h1>
        <p class="mb-6 ">
          {{ $t("changePassword.description") }}
        </p>
        <form action="" class="mb-4" @submit.prevent="authUser(loginForm)">
          <div class="mb-4">
            <p class="mb-1 ">{{ $t("changePassword.newPass") }}</p>
            <input
                v-model="loginForm.email"
                class="rounded-md border py-2 px-4 w-full text-black"
                placeholder="●●●●●●●●●●"
                required
                type="password"
            />
          </div>
          <div class="mb-4">
            <p class="mb-1 ">{{ $t("changePassword.confirmPass") }}</p>
            <input
                v-model="loginForm.email"
                class="rounded-md border py-2 px-4 w-full text-black"
                placeholder="●●●●●●●●●●"
                required
                type="password"
            />
          </div>
          <button
              class="text-center bg-secondaryColor text-white w-full rounded-md py-3"
              type="submit"
          >
            {{ $t("changePassword.button") }}
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

export default {
  name: "ChangePassword",
  setup() {
    useMeta({title: "Авторизация"});
  },
  data() {
    return {
      loginForm: {
        password: "",
        confirm_password: null,
      },
      rememberMe: false,
    };
  },
  computed: {
    ...mapGetters(["getAuth"]),
  },
  methods: {
    ...mapActions(["authUser"]),
  },
};
</script>