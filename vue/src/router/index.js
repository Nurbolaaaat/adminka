import {createRouter, createWebHistory} from "vue-router";
import MainPage from "@/views/MainPage/index.vue";
import Auth from "@/views/Authentification/index.vue";
import PassRecovery from "@/views/Authentification/PassRecovery/index.vue";
import ChangePassword from "@/views/Authentification/ChangePassword/index.vue";
import CreatePage from "@/views/CreatePage/index.vue";
import UpdatePage from "@/views/UpdatePage/index.vue";
import RegistrationPage from "@/views/RegistrationPage/index.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "MainPage",
            component: MainPage,
            meta: {requiresAuth: true, title: "Главная"},
        },
        {
            path: "/create",
            name: "CreatePage",
            component: CreatePage,
            meta: {requiresAuth: true, title: "Создание поста"},
        },
        {
            path: "/registration",
            name: "RegistrationPage",
            component: RegistrationPage,
            meta: {requiresAuth: false, title: "Регистрация"},
        },
        {
            path: "/update/:id",
            name: "UpdatePage",
            component: UpdatePage,
            meta: {requiresAuth: true, title: "Редактирование поста"},
        },
        {
            path: "/auth",
            name: "Auth",
            component: Auth,
        },
        {
            path: "/auth/password-recovery",
            name: "PasswordRecovery",
            component: PassRecovery,
        },
        {
            path: "/auth/change-password",
            name: "ChangePassword",
            component: ChangePassword,
        }
    ]
});


router.beforeEach(async (to, from, next) => {
    const isAuthenticated = localStorage.getItem("token");
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            next("/auth");
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.path === "/auth")) {
        if (isAuthenticated) {
            next("/");
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;

