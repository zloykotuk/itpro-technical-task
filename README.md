### Запуск backend-у

Запуск Docker контейнерів (веб сервер та база даних)
```shell
./vendor/bin/sail up -d
```

Підняти міграції та запустити seeder для заповнення таблиць тестовими даними
```shell
./vendor/bin/sail artisan migrate --seed
```

### Запуск frontend-у

#### Якщо запуск йде через wsl, то краще запускати напряму з під Windows :) 

Установка пакетів
```shell
npm i
```

Запуск дев сервера 
```shell
npm run dev
```

#### Якщо все-таки використуєте Linux або MacOS то тоді можна використати sail  

Установка пакетів
```shell
./vendor/bin/sail npm i
```

Запуск дев сервера
```shell
./vendor/bin/sail npm run dev
```
