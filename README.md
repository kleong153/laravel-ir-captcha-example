# Laravel IR Captcha Example Project

This is an example project to demo how to implement [Laravel IR Captcha](https://github.com/kleong153/laravel-ir-captcha) library.


## Requirements
Make sure the following PHP extensions are installed:
- ```gd```
- ```pdo_sqlite``` (only required if you wan to use the included SQLite database setup in this example project. You can ignore this extension and use your own database instead).

## Setup Instructions
1. Clone this repository.
2. Run ```composer install``` command to install dependencies.
3. Edit ```APP_URL``` in ```.env``` file according to your local virtual host configuration.
3. Run ```php artisan migrate``` command for database migrations.
4. Run ```php artisan storage:link``` command to create symbolic link for storage.

## Usage
Refer to ```resources/views/login.blade.php``` for example of how to integrate IR Captcha with your UI framework (Bootstrap 5 is used in this project).

## Customization
You can customize the IR Captcha behavior, language, and view templates through the following files:
- ```config/ir-captcha.php```
- ```lang/vendor/ir-captcha/en/messages.php```
- ```resources/views/vendor/irCaptcha.blade.php```
