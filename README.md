### Шаг 1

Скопировать .env.example
```shell
cp .env.example .env
```

в .env файле заполните следующие поля

```shell
SUBNET=192.168.100.0/24 # пул айпишников для контейнеров
UID= # id пользователя можно узнать коммандой id в linux
GID= # id группы пользователя можно узнать коммандой id в linux
APP_PATH= # путь до папки с проектом команда pwd
```
запустите контейнеры

```shell
docker-compose up
```

### Шаг 2

Зайдите в контейнер с php-fpm и скачайте зависимости и сгенерируйте ключ испоьзуя следующие команды:
```shell
docker exec -it <container name> bash #<container name> по умолчаниию env_php
# внутри контейнера
composer install
npm install
npm run dev
php artisan key:generate
# внутри контейнера
```

выйдите из контейнера командой `exit`

### Шаг 3
отредактируйте файл `/etc/hosts` добавив host: <br>
`192.168.100.1 dev.itn.com` <br>
или ip заканчиваюшийся 1 из пула который вы указали в вайле среды `.env` в поле `SUBNET` (смотрите Шаг 1)

### ШАГ 4

перейдите в браузере dev.itn.com и попробуйте ввести инн

