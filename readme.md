[![Build Status](https://travis-ci.org/hamzahjamad/headhunters.svg?branch=master)](https://travis-ci.org/hamzahjamad/headhunters)

## About HeadHunters

Headhunters is... what matter is i create it using Laravel.

## Setting Up

Interested on testing it on your own machine? Read this list on how to make it working.

1. Download or clone this repository , either to your machine or your own server.
1. In your server or machine, create a new database
1. Copy .env.example to .env
1. Change the DB_DATABASE=homestead DB_USERNAME=homestead DB_PASSWORD=secret into the new database name you created earlier, then put the username and password
1. Install everything by running this command in the terminal, "composer install" , without the quotes
1. Run the generating key command in the terminal as well, "php artisan key:generate" , without the quotes
1. Run the migration command in the terminal, "php artisan migrate", without the quotes
1. Inserting the seeder into database, "php artisan db:seed", without the quotes
1. Lastly make a symbolic link from our storage into public directory, "php artisan storage:link" , without quotes
1. Now everything are ready to use, open your browser and test it.

## Demo Site

Too lazy to set it up on your machine? Currently i'm setting up a demo server, so stay tune.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Security Vulnerabilities

If you discover a security vulnerability within this webapp, please send an e-mail to Hamzah Jamad at hamzahjamad@gmail.com. All security vulnerabilities will be promptly addressed.

## License

This webapp is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
