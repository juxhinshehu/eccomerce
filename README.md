## Installation commands

git clone https://github.com/juxhinshehu/eccomerce.git

composer install

composer and npm install (since laravel ui is used)

php artisan migrate

you may need to execute: composer dump-autoload

php artisan db:seed

configure variables in .env . especially ADMIN_EMAIL, MAIL_USERNAME, MAIL_PASSWORD, DB_DATABASE
DB_USERNAME, DB_PASSWORD

You may also need to allow you email provider access to less secure apps.

php artisan config:cache

When using the application the jobs must be running : php artisan queue:listen


## Usage Manual

Under the main root of the app is the product list. After clicking buy you get redirected to /checkout. If any of the fields is left empty appropriate error messages are going to appear. For the sake of testing I use the charges api. I have tested it using test data from stipe:

credit or debit card: 4242 4242 4242 4242 , for date any future date for instance 12/22 . For CVC any 3 digit number works. And for zip any US and Canadian Zip works. For example 85005