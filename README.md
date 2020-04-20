#### Aвтоматически генерируемый файл sitemap.xml по данным из таблицы

* copy .env.example file to .env file (**add your db details**)
* composer install
* php artisan key:generate
* php artisan migrate:fresh
* php artisan storage:link
* php artisan serve

* server started: http://127.0.0.1:8000


