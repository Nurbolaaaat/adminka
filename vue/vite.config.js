import {fileURLToPath} from 'node:url'
import {dirname, resolve} from 'node:path'
import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'
import eslintPlugin from 'vite-plugin-eslint';

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {}
        }
    }, plugins: [eslintPlugin({
        exclude: [/virtual:/, /node_modules/]
    }), vue({
        template: {
            compilerOptions: {
                isCustomElement: (tag) => ["MultiSelect", "LoadingAnimation"].includes(tag)
            }
        }
    }),
        VueI18nPlugin({
            runtimeOnly: false, include: resolve(dirname(fileURLToPath(import.meta.url)), './src/i18n/locales/**'),
        })], server: {
        port: 3000,
    }, resolve: {
        alias: {
            '@': fileURLToPath(new URL("./src", import.meta.url)),
        },
    }
})
