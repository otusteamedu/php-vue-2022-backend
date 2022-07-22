# SPA на PHP + Vue.js: back-end

В этом репозитории размещены учебные материалы для открытого урока по созданию
одностраничного приложения на Symfony и Vue.js с использованием
чистой архитектуры.

Ссылка на запись: https://youtu.be/KJsuEmxMdfc

ВАЖНО: это учебное приложение с фокусом на архитектуру. При его разработке 
были осознанно проигнорированы требования к покрытию тестами, безопасности, эксплуатации и т.д.

## Системные требования

- PHP >= 8.1
- Composer 2
- PostgreSQL >= 12 с заранее созданной БД
- Любой веб-сервер (в репозитории есть готовый .htaccess для Apache)

## Установка

Клонируем репозиторий:

```
$ git clone git@github.com:otusteamedu/php-vue-2022-backend.git
```

Устанавливаем зависимости:

```
$ composer install
```

Генерируем ключи для JWT:

```
$ php bin/console lexik:jwt:generate-keypair
```

Создаём локальный .env-файл:

```
$ cp .env .env.local
```

Вносим правки в конфигурацию (см. ниже), после чего запускаем миграции:

```
$ php bin/console doctrine:migrations:migrate 
```

## Конфигурация

- БД: DATABASE_URL
- CORS: CORS_ALLOW_ORIGIN

Пример конфигурации из открытого урока:

```
DATABASE_URL="postgresql://otus_php_api:********@127.0.0.1:5432/otus_php_api?serverVersion=12&charset=utf8"
CORS_ALLOW_ORIGIN='^http://otus-php-api-front.localhost$'
```

## Использование

- Запускаем приложение https://github.com/otusteamedu/php-vue-2022-frontend
- Входим в систему с именем otus и паролем qwertyasdfgh
