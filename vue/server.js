const express = require("express");
const { createProxyMiddleware } = require("http-proxy-middleware");

// Создаем экземпляр Express.js приложения
const app = express();

// Задаем путь для статических файлов (если нужно)
app.use(express.static("dist"));

// Настройка прокси-маршрута для Vite dev-сервера
app.use(
  "/api", // Задайте ваш путь к API или другому ресурсу
  createProxyMiddleware({
    target: "http://localhost:3000", // Задайте адрес вашего Vite dev-сервера
    changeOrigin: true,
    ws: true,
  })
);

// Запуск сервера
const port = 4000; // Задайте порт сервера по вашему выбору
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
