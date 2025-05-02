# Laravel IR Captcha Example Project

This is an example project to demo how to implement [Laravel IR Captcha](https://github.com/kleong153/laravel-ir-captcha) library.

## Getting Started
- [Option 1: Using Docker](#option-1-using-docker)
- [Option 2: Manual Installation](#option-2-manual-installation)

### Option 1: Using Docker
#### Setup Instructions
1. Clone this repository.
2. Run ```composer install``` to install dependencies.
3. Run ```docker-compose up --build``` to build and start the Docker container.
4. Visit ```localhost:8000``` in web browser.

### Option 2: Manual Installation
#### Prerequisites
Ensure the following PHP extensions are installed:
- ```gd```
- ```pdo_sqlite``` (only required if you wan to use the included SQLite database setup in this example project. You may ignore this extension and use your own database config instead).

#### Setup Instructions
1. Clone this repository.
2. Copy .env.example file, paste and rename as .env file.
3. Edit ```APP_URL``` value in ```.env``` file according to your local virtual host configuration.
4. Run ```composer install``` to install dependencies.
5. Run ```php artisan key:generate``` to generate project key.
6. Run ```php artisan migrate``` command for database migrations.
7. Run ```php artisan storage:link``` to create symbolic link for storage.

## Usage
Refer to ```resources/views/login.blade.php``` for example of how to integrate IR Captcha with your UI framework (Bootstrap 5 is used in this project).

## Customization
You can customize the IR Captcha behavior, language, and view templates through the following files:
- ```config/ir-captcha.php```
- ```lang/vendor/ir-captcha/en/messages.php```
- ```resources/views/vendor/irCaptcha.blade.php```
