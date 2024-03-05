docker compose exec -T laravel.test  chmod -R 777 storage/ bootstrap/
docker compose exec -T laravel.test  cp .env.example .env
docker compose exec -T laravel.test  composer install
docker compose exec -T laravel.test  php artisan migrate
docker compose exec -T laravel.test  php artisan db:seed
docker compose exec -T laravel.test  cp vue/.env.example vue/.env
