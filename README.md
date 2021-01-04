composer install 

cp .env.example .env

php artisan jwt:secret

php artisan migrate

php artisan db:seed

I added email notification using SendPulse service but commented it because I need token from them 
and right now I dont have possibility to get if, just check code please

php artisan serve


user: admin@email.com
password: 123456
