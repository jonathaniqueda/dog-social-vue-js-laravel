#DogSocial - VueJS 2.0 and Laravel 5.5 Project

This is a little personal project made with VueJS 2.0 (plus Vuex, VeuRouter and VeeValidate) and Laravel 5.5 (just for API).

To install:

1) Clone the project.
2) Create an env file based on .env.example.
3) Run composer install.
4) Run `php artisan migrate && php artisan key:generate && php artisan storage:link && php artisan jwt:generate`
5) Get the JWT Secret and set in on .env like: JWT_SECRET=KEY_GENERATED
5) Now just create an VHOST to this project or run `php artisan server`.
6) If you get a bug in `php artisan jwt:generate`, run this command: `composer require tymon/jwt-auth:dev-develop --prefer-source`.
7) After that run again `php artisan jwt:generate` and set the value on .env file.

If you get path errors (boostrap/ or storage/ errors), just see this article: `https://stackoverflow.com/questions/38208263/laravel-5-2-bootstrap-cache-services-php-missing`

Thanks,
Jonathan Iqueda.