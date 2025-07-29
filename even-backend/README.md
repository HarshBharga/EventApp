
## Back-end Setup

1. Requirements
php 8.4, 
mysql 8.0

2. Clone this repository
3. Then go to directory path in your terminal
`cd even-backend`

4. Install 
`composer install`

5. Update DB configuration in .env file.

`DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=eventapp
 DB_USERNAME=root
 DB_PASSWORD=`

6. Dump some event data and admin credentials
`php artisan migrate:fresh --seed`

7. Run Server
`php artisan serve`

`http://127.0.0.1:8000`

8. Login
Email: `admin@admin.com`
Pass: `Admin@123`
