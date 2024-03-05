// vite.config.js
import { fileURLToPath } from "node:url";
import { dirname, resolve } from "node:path";
import { defineConfig } from "file:///C:/Users/it20/Desktop/cabinet/node_modules/vite/dist/node/index.js";
import vue from "file:///C:/Users/it20/Desktop/cabinet/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import path from "path";
import VueI18nPlugin from "file:///C:/Users/it20/Desktop/cabinet/node_modules/@intlify/unplugin-vue-i18n/lib/vite.mjs";
import eslintPlugin from "file:///C:/Users/it20/Desktop/cabinet/node_modules/vite-plugin-eslint/dist/index.mjs";
var __vite_injected_original_dirname = "C:\\Users\\it20\\Desktop\\cabinet";
var __vite_injected_original_import_meta_url = "file:///C:/Users/it20/Desktop/cabinet/vite.config.js";
var vite_config_default = defineConfig({
  plugins: [
    eslintPlugin({
      exclude: [/virtual:/, /node_modules/]
    }),
    vue({
      template: {
        compilerOptions: {
          isCustomElement: (tag) => ["MultiSelect", "LoadingAnimation"].includes(tag)
        }
      }
    }),
    VueI18nPlugin({
      runtimeOnly: false,
      include: resolve(dirname(fileURLToPath(__vite_injected_original_import_meta_url)), "./src/i18n/locales/**")
    })
  ],
  server: {
    port: 3e3
  },
  resolve: {
    alias: {
      "@": path.resolve(__vite_injected_original_dirname, "./src")
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxpdDIwXFxcXERlc2t0b3BcXFxcY2FiaW5ldFwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcVXNlcnNcXFxcaXQyMFxcXFxEZXNrdG9wXFxcXGNhYmluZXRcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L1VzZXJzL2l0MjAvRGVza3RvcC9jYWJpbmV0L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHtmaWxlVVJMVG9QYXRofSBmcm9tICdub2RlOnVybCdcclxuaW1wb3J0IHtkaXJuYW1lLCByZXNvbHZlfSBmcm9tICdub2RlOnBhdGgnXHJcbmltcG9ydCB7ZGVmaW5lQ29uZmlnfSBmcm9tICd2aXRlJ1xyXG5pbXBvcnQgdnVlIGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZSdcclxuaW1wb3J0IHBhdGggZnJvbSAncGF0aCdcclxuaW1wb3J0IFZ1ZUkxOG5QbHVnaW4gZnJvbSAnQGludGxpZnkvdW5wbHVnaW4tdnVlLWkxOG4vdml0ZSdcclxuaW1wb3J0IGVzbGludFBsdWdpbiBmcm9tICd2aXRlLXBsdWdpbi1lc2xpbnQnO1xyXG5cclxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcclxuICAgIHBsdWdpbnM6IFtcclxuICAgICAgICBlc2xpbnRQbHVnaW4oe1xyXG4gICAgICAgICAgICBleGNsdWRlOiBbL3ZpcnR1YWw6LywgL25vZGVfbW9kdWxlcy9dXHJcbiAgICAgICAgfSksXHJcbiAgICAgICAgdnVlKHtcclxuICAgICAgICAgICAgdGVtcGxhdGU6IHtcclxuICAgICAgICAgICAgICAgIGNvbXBpbGVyT3B0aW9uczoge1xyXG4gICAgICAgICAgICAgICAgICAgIGlzQ3VzdG9tRWxlbWVudDogKHRhZykgPT4gW1wiTXVsdGlTZWxlY3RcIiwgXCJMb2FkaW5nQW5pbWF0aW9uXCJdLmluY2x1ZGVzKHRhZylcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pLFxyXG4gICAgICAgIFZ1ZUkxOG5QbHVnaW4oe1xyXG4gICAgICAgICAgICBydW50aW1lT25seTogZmFsc2UsXHJcbiAgICAgICAgICAgIGluY2x1ZGU6IHJlc29sdmUoZGlybmFtZShmaWxlVVJMVG9QYXRoKGltcG9ydC5tZXRhLnVybCkpLCAnLi9zcmMvaTE4bi9sb2NhbGVzLyoqJyksXHJcbiAgICAgICAgfSldLFxyXG4gICAgc2VydmVyOiB7XHJcbiAgICAgICAgcG9ydDogMzAwMCxcclxuICAgIH0sXHJcbiAgICByZXNvbHZlOiB7XHJcbiAgICAgICAgYWxpYXM6IHtcclxuICAgICAgICAgICAgJ0AnOiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAnLi9zcmMnKSxcclxuICAgICAgICB9LFxyXG4gICAgfVxyXG59KVxyXG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQW1SLFNBQVEscUJBQW9CO0FBQy9TLFNBQVEsU0FBUyxlQUFjO0FBQy9CLFNBQVEsb0JBQW1CO0FBQzNCLE9BQU8sU0FBUztBQUNoQixPQUFPLFVBQVU7QUFDakIsT0FBTyxtQkFBbUI7QUFDMUIsT0FBTyxrQkFBa0I7QUFOekIsSUFBTSxtQ0FBbUM7QUFBa0ksSUFBTSwyQ0FBMkM7QUFRNU4sSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsYUFBYTtBQUFBLE1BQ1QsU0FBUyxDQUFDLFlBQVksY0FBYztBQUFBLElBQ3hDLENBQUM7QUFBQSxJQUNELElBQUk7QUFBQSxNQUNBLFVBQVU7QUFBQSxRQUNOLGlCQUFpQjtBQUFBLFVBQ2IsaUJBQWlCLENBQUMsUUFBUSxDQUFDLGVBQWUsa0JBQWtCLEVBQUUsU0FBUyxHQUFHO0FBQUEsUUFDOUU7QUFBQSxNQUNKO0FBQUEsSUFDSixDQUFDO0FBQUEsSUFDRCxjQUFjO0FBQUEsTUFDVixhQUFhO0FBQUEsTUFDYixTQUFTLFFBQVEsUUFBUSxjQUFjLHdDQUFlLENBQUMsR0FBRyx1QkFBdUI7QUFBQSxJQUNyRixDQUFDO0FBQUEsRUFBQztBQUFBLEVBQ04sUUFBUTtBQUFBLElBQ0osTUFBTTtBQUFBLEVBQ1Y7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLE9BQU87QUFBQSxNQUNILEtBQUssS0FBSyxRQUFRLGtDQUFXLE9BQU87QUFBQSxJQUN4QztBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
