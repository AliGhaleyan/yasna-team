# Ticketing App

Run migrations:
```shell
php artisan migrate
```

Run database seeder:
```shell
php artisan db:seed
```

Install passport:
```shell
php artisan passport:install
```

Add `TICKET_EXPIRE_MINUTES` to `env` variables for no answer tickets expiration times. By default is `24 * 60`.

### Auto Close Expired Tickets
Run schedule:
```shell
php artisan schedule:work
```
