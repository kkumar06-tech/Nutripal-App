<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Nutipal Backend

This project is the backend for Nutipal, built with Laravel, a web application framework with expressive, elegant syntax. Laravel makes development enjoyable and eases common tasks used in many web projects.

## About Laravel

Laravel provides tools required for large, robust applications, including:

- Simple, fast routing engine.
- Powerful dependency injection container.
- Multiple back-ends for session and cache storage.
- Expressive, intuitive database ORM.
- Database agnostic schema migrations.
- Robust background job processing.
- Real-time event broadcasting.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has extensive documentation and a video tutorial library, making it easy to get started. Resources include:

- **Laravel Documentation**: Extensive, detailed, and up-to-date.
- **Laravel Bootcamp**: A guided approach to building a Laravel application from scratch.
- **Laracasts**: Thousands of video tutorials on Laravel, modern PHP, unit testing, and more.

## Branch Information

- **main**: Contains the backend code for the application.
- **FrontEnd**: Contains the React code for the frontend.
- **dokumentation-style-guide**: Contains user documentation and the style guide.

## Installation

To set up the backend locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://gitlab.hof-university.de/mariii/testing.git
   ```
2. Navigate to the backend directory:
   ```bash
   cd testing
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Set up the environment:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other settings.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```


## Directory Structure

- **Controllers/**: Helps to set the api for the Databank.
- **Models/**: Files defining the relation between diffrent tables of Database.
- **Migrations/**:Files that generate Tables and define the Schema  .
- **Seeders/**:Contain the preloaded examples for the Database .
- **Tests**: Contains the test cases for the Controller in our case (Food Controller).


## Available Scripts

In the project directory, you can run:

### `php artisan serve`

Runs the app in the development mode.

- Open [http://localhost:3000](http://localhost:3000) to view it in your browser.


### `php artisan test`

Launches the tests in terminal.

The test file is located in `Test -> Feature -> FoodControllerTest.php `.

In-built Test runner , dont require any dependencies. 



## Dependencies Check

If the app encounters errors during runtime, verify that all required dependencies are installed. Here is the list of dependencies used in this project:

```json
"dependencies": {
 
   "require": {
   "php": "^8.2",
    "laravel/framework": "^11.31",
    "laravel/sanctum": "^4.0",
    "laravel/tinker": "^2.9",
    "laravel/ui": "^4.6"
    },
    "require-dev": {
     "fakerphp/faker": "^1.23",
     "laravel/pail": "^1.1",
     "laravel/pint": "^1.13",
     "laravel/sail": "^1.26",
     "mockery/mockery": "^1.6",
     "nunomaduro/collision": "^8.1",
     "phpunit/phpunit": "^11.0.1"
    },
    

}
```

To install missing dependencies, use the following commands:

```bash
php artisan install <dependency_name>
```

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via taylor@laravel.com. All security vulnerabilities will be promptly addressed.


## Contributors

- **Marija Voloder** – Developer/Student
- **Thi Thanh Truc Trinh** – Developer/Student
- **Keshav** – Developer/Student
- **Andrej Bachmann** – Academic Guidance

