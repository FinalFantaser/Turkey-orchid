#  Установка
```sh
composer install
```

```sh
php artisan key:generate
```

#  Настройка базы данных
```sh
cp .env.example .env
```

```sh
touch database/database.sqlite
```

```sh
php artisan migrate --seed
```

```sh
php artisan orchid:install
```

```sh
php artisan orchid:admin <имя> <e-mail> <пароль>
```
