Клонируем репозиторий

git clone https://github.com/traumer02/t-app.git
__________________________________________________________________
 Создаём .env

cp .env.example .env
__________________________________________________________________
Поднимаем Docker

docker compose up -d --build

docker ps 

заходим в контейнер приложении
docker exec -it ..... bash
__________________________________________________________________
Запускаем миграции и сидеры

php artisan migrate

php artisan db:seed
