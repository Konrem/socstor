#Інструкції
- clone repo
- composer install
- copi or rename .env.example .env config db
- php artisan key:generate
- php artisan storage:link
- php artisan migrate --seed
- npm install
- create dir: uploads, photo, cover in storage/app/public/ and added permissions
- added permissions to storage/logs/ & storage/framework/sessions/ &  storage/framework/views/

> SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key
> length is 767 bytes протрібно прописати ```Schema::defaultStringLength(191);``` в
> app\Providers\AppServiceProvider.php


При першій установці прописати `php artisan migrate --seed`

Якщо база даних пише що не вичтачає якихось полів то потрібно набрати cli `php artisan migrate:fresh --seed`
## Щоб мати можливість зберігати файли та читати їх потрібно виконати команду:
php artisan storage:link

## Користувачі
Щоб додати користувача потрібно в терміналі набрати команду `php artisan db:seed`
- User data: email: user@gmail.com password: 12345678
- Admin data: email: admin@gmail.com password: 12345678

## Помилки
> Якщо сіди не виконуються, то потрібно виконати команду `composer dump-autoload`
> Якщо додали новий компонент то потрібно також виконати `composer dump-autoload`
