#  Установка
```sh
composer install
```

```sh
php artisan key:generate
```

```sh
php artisan storage:link
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
Выбрать ответ 'no'


```sh
php artisan orchid:admin <имя> <e-mail> <пароль>
```
