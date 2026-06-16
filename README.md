# Library Management System (Laravel)

A Laravel-based web application to manage library data such as books, shelves, students, borrowings, and returns.  
All features are protected and can only be accessed after login.

## Default Login
- Admin :
    
    email = 'admin@gmail.com' |
    Password = 'password'

- Staff :

    email = 'staff@gmail.com' |
    Password = 'password'

- User :

    email = 'user@gmail.com' |
    Password = 'password'

## Setup & Run

1. Clone the project

    ```git clone https://github.com/andrianfaiza/library-management-system.git```

    ```cd library-management-system```

    ```cd app-perpus```

2. Seeder Migration
    ```php artisan db:seed```

3. Install dependencies

    composer install

4. Copy environment file

    cp .env.example .env

5. Configure database in `.env`

    DB_DATABASE=library-app
    DB_USERNAME=root 
    DB_PASSWORD=

6. Generate application key

    php artisan key:generate

7. Run the server

    php artisan serve
    
    Open in browser:
    
    http://127.0.0.1:8000
