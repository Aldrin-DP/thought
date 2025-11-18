# Thought? 

A simple blog application where users can share their thoughts and engage in discussions through posts and comments. 

## Features

- **Create Posts**: Users can write and publish blog posts
- **Comment System**: Engage with posts through comments
- **User Authentication**: Secure login and registration
- **CRUD Operations**: Full Create, Read, Update, and Delete functionality

## Learning Goals

This project was built to practice and demonstrate:
- Laravel CRUD operations
- Eloquent ORM relationships (One-to-Many, belongs to)
- User authentication and authorization
- Form validation
- RESTful API design patterns

## Tech Stack

- **Backend**: Laravel 
- **Database**: MySQL

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Aldrin-DP/thought.git
   cd thought
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your database**
   
   Update your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=thought
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run database migrations**
   ```bash
   php artisan migrate
   ```

6. **Build frontend assets**
   ```bash
   npm run dev
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser



## Author

**Aldrin Pelayo**

- GitHub: [@Aldrin-DP](https://github.com/Aldrin-DP)
- Portfolio: [https://adpelayo.netlify.app](https://adpelayo.netlify.app)
---

If you found this project helpful for learning Laravel, please give it a star!