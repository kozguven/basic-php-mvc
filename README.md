# Basic MVC PHP

A simple PHP MVC (Model-View-Controller) framework demonstrating the basic principles of MVC architecture. This framework includes user authentication and session management.

## Features

- **MVC Architecture**: Separation of concerns into Models, Views, and Controllers.
- **User Authentication**: Basic user registration and login functionality.
- **Session Management**: Handling user sessions for authenticated access.
- **Database Interaction**: PDO-based database interactions.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/kozguven/basic-mvc-php.git
    ```

2. Navigate to the project directory:
    ```sh
    cd basic-mvc-php
    ```

3. Create a MySQL database and import the following schema:
    ```sql
    CREATE DATABASE your_database;
    USE your_database;

    CREATE TABLE messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message VARCHAR(255) NOT NULL
    );

    INSERT INTO messages (message) VALUES ('Hello, MVC World with Database!');

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

4. Update the database configuration in `app/core/Database.php` with your database credentials:
    ```php
    private $host = 'localhost';
    private $db_name = 'your_database';
    private $username = 'your_username';
    private $password = 'your_password';
    ```

5. Start a PHP development server:
    ```sh
    php -S localhost:8000 -t public
    ```

6. Open your browser and navigate to `http://localhost:8000`.

## Directory Structure
basic-mvc-php/
├── app/
│   ├── controllers/
│   │   ├── HomeController.php
│   │   └── UserController.php
│   ├── models/
│   │   ├── HomeModel.php
│   │   └── UserModel.php
│   ├── views/
│   │   ├── home.php
│   │   ├── register.php
│   │   └── login.php
│   └── core/
│       ├── Router.php
│       ├── Controller.php
│       ├── Model.php
│       └── Database.php
├── public/
│   └── index.php
└── .htaccess

## Usage

- **Home Page**: Accessible at `/`, but requires login.
- **User Registration**: Accessible at `/register`.
- **User Login**: Accessible at `/login`.
- **User Logout**: Accessible at `/logout`.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
