## About Karengata SDA Backend - CIMS

This KSDA-Backend is a web application developed by [Laravel framework](https://laravel.com/). It has the following API Features:

- Users and Roles Management
- Prayercell Management
- Country Management
- Department Management
- Folders Management
- Status Management
- Position Management
- Industry Management
- Membership Type Management
- Payment Modes Management

## Requirements

- PHP version 8.1+
- PHP Mcrypt
- PHP Mysql
- Composer
- mbstring
- dom extention
- php8.1-fpm

## Installation Steps

- Clone the repository with **git clone -- file name**
- Copy **.env.example** file to **.env** and edit database credentials there
- Run **composer install**
- Run **php artisan key:generate**
- Run **php artisan migrate --seed**
- That's it - load the homepage, and log in with credentials e.g **admin@admin.com / mypassword.**

## License

This Application is developed and licensed under the [KSDA TECH TEAM](https://karengatasda.org/).