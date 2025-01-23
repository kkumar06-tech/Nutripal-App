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

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the Laravel documentation.

## Code of Conduct

To ensure that the Laravel community is welcoming to all, please review and abide by the Code of Conduct.

## License

The Laravel framework is open-sourced software licensed under the MIT license.

## Contributors

- **Marija Voloder** – Developer/Student
- **Thi Thanh Truc Trinh** – Developer/Student
- **Keshav** – Developer/Student
- **Andreij Bachmann** – Academic Guidance

