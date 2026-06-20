# 📚 Library Management System (Laravel)

A Laravel-based web application to manage library data such as books, shelves, students, borrowings, and returns.  
All features are protected and can only be accessed after login.

<p align="center">
<a href="#-about-project"><strong>About</strong></a> •
<a href="#-features"><strong>Features</strong></a> •
<a href="#-requirements"><strong>Requirements</strong></a> •
<a href="#-installation"><strong>Installation</strong></a> •
<a href="#-running-the-application"><strong>Running</strong></a> •
<a href="#-default-login"><strong>Login</strong></a>
</p>

---

## 🎯 About Project

Library Management System is a comprehensive web application to manage library data including books, shelves, students, borrowings, and returns. All features are protected and can only be accessed after login with role-based access control.

## 🛠️ Technology

**Backend:**
- **Laravel** v12.0 - Powerful PHP Framework
- **PHP** ^8.2 - Server-side programming language
- **Spatie Laravel Permission** v6.25 - Role and Permission management

**Frontend:**
- **Tailwind CSS** v3.1 - Utility-first CSS framework
- **Alpine JS** v3.4 - Lightweight JavaScript framework
- **Vite** v7.0 - Next generation frontend tooling
- **Axios** v1.11 - HTTP client for API requests

**Database & Tools:**
- **Laravel Breeze** - Authentication scaffolding
- **Pest PHP** - Modern testing framework
- **Laravel Tinker** - Interactive shell

## ✨ Features

- ✅ **Book Management** - Add, edit, delete, and view books
- ✅ **Shelf Management** - Organize books by shelves
- ✅ **Student Management** - Manage student data and information
- ✅ **Borrowing System** - Track book borrowings with due dates
- ✅ **Return System** - Process book returns and calculate fines
- ✅ **User Authentication** - Role-based access control (Admin, Staff, User)
- ✅ **Dashboard** - Overview of library statistics and activities

## 📋 Requirements

Before getting started, make sure you have installed:

- **PHP** >= 8.2
- **Composer** >= 2.2
- **Node.js** >= 16.0
- **npm** or **yarn**
- **MySQL** or other database
- **Git**

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/andrianfaiza/library-management-system.git
cd library-management-system
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database

Configure the database in `.env` file:

```env
DB_DATABASE=library-app
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Database Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Frontend Assets

```bash
npm run build
```

## 🎮 Running the Application

### Development Mode

Run the application in development mode:

```bash
php artisan serve
```

The application will be available at: `http://127.0.0.1:8000`

### Production Mode

For production, build frontend assets first:

```bash
npm run build
```

Then run the server:

```bash
php artisan serve
```

## 🔐 Default Login

Use the following credentials to access the application:

**Admin:**
- Email: `admin@gmail.com`
- Password: `password`

**Staff:**
- Email: `staff@gmail.com`
- Password: `password`

**User:**
- Email: `user@gmail.com`
- Password: `password`

## 📝 Environment Configuration

Configure the application through the `.env` file:

```env
APP_NAME="Library Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library-app
DB_USERNAME=root
DB_PASSWORD=
```

## 📄 License

This project is licensed under the MIT License.

---

<div align="center">

**Built with ❤️ using Laravel**

[⬆ Back to top](#-library-management-system-laravel)

</div>
