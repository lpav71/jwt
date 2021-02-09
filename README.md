<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Установка

composer update

php artisan jwt:secret



## Как пользоваться

POST ../api/auth/registration - зарегистрироваться

Ключи - name, password, email

POST ../api/auth/login - вход в систему (в ответ прийдет access_token и token_type. Далее этот токен нужно отправить в заголовке во всех запросах 'Authorization: 'тут пишем  token_type пробел access_token)

Ключи - email, password

POST ../api/auth/me - отобразит все данные по текущему пользователю

GET ../api/note - получить все заметки пользователя

POST  ../api/note - добавит новую запись

Ключи - record => сама новая запись

PUT  ../api/note/id - изменит запись  с указанным id

id - id изменяемой записи

Ключи - record => здесть пишем новую запись. Ей будет заменена старая.

DELETE  ../api/note/id - удалит запись с указанным id

id - id изменяемой записи

