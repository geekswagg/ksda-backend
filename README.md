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
- Document Management
- Members Management

## Requirements

- PHP version 8.1+
- PHP Mcrypt
- PHP Mysql
- Composer
- mbstring
- dom extention
- php8.1-fpm

## Installation Steps
## Step 1: Database Creation
- To access the MariaDB prompt after installing the database server, you need to use the following command: **mysql -u root -p**
- Sign in, then create a database and a user for it; grant the database user the necessary permissions.
- CREATE DATABASE laravel_db;
- CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'secretpassword';
- GRANT ALL ON laravel_db.* TO 'laravel_user'@'localhost';
- FLUSH PRIVILEGES;
- QUIT;

## Step 2: Composer Installation
- Composer is a package manager and prerequisite management tool for PHP and manages the libraries and dependencies required by PHP based on the particular framework.
- Use this command: **curl -sS https://getcomposer.org/installer | php**
- After executing the above command, the composer. phar file will be downloaded, and to move the file to the usr/local/bin/ path, run the following command:
**sudo mv composer.phar /usr/local/bin/composer**
- Assign authority to execute: **sudo chmod +x /usr/local/bin/composer**

## Step 3: Laravel Installation and setup

- To install Laravel, you must first go to the webroot directory, and for this purpose, you must type the following command: **cd /var/www/html**
- Clone the repository with **git clone -- file name** e.g. **git clone git@github.com:KarengataSDA/ksda-backend.git**
- Set the web server user to own the Laravel directory. **sudo chown -R www-data:www-data /var/www/html/ksda-backend**
- Change Permissions for the storage Directoryt. **sudo chmod -R 775 /var/www/html/ksda-backend/storage**
- Once the installation process is finished, go to the installation directory. **cd /var/www/html/ksda-backend** then follow the steps below.
- Copy **.env.example** file to **.env** and edit database credentials there
- Run **composer install**
- Run **php artisan key:generate**
- Run **php artisan migrate**
- Run **php artisan db:seed**
- That's it - load the homepage, **localhost/ksda-backend/public** and log in with credentials e.g **admin@admin.com / mypassword.**

## License

This Application is developed and licensed under the [KSDA TECH TEAM](https://karengatasda.org/).