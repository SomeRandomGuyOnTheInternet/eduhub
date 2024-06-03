# EduHub

EduHub is an open-source Learning Management System (LMS).

## Installation
Subject to change, still need install stuff for database.
- Install PHP
- Install Composer
- Install Node and NPM
- Install MySQL

## Run
**Note:** A .env file is needed to run the app. Contact admin for more details.<br>
Run the following code.

> ```
> cd src
> ```
> ```
> php artisan serve
> ```

## Steps to Run (03/04/2024)
1. Run composer install in terminal
2. Rename .env.example to .env
3. In .env, change DB password (line 27)
4. In MySQL Workbench, create a database named eduhub_db
5. Run php artisan migrate in terminal
6. Run php artisan key:generate in terminal
7. Run php artisan storage:link in terminal
8. Run npm install in terminal
9. Run npm run dev in terminal
10. Open another terminal, run php artisan serve
