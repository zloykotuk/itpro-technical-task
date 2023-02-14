

Запуск Docker контейнерів (веб сервер та база даних)
```shell
./vendor/bin/sail up -d
```

Підняти міграції та запустити seeder для заповнення таблиць тестовими даними
```shell
./vendor/bin/sail artisan migrate --seed
```
