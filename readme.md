[![Build Status](https://travis-ci.org/hamzahjamad/headhunters.svg?branch=master)](https://travis-ci.org/hamzahjamad/headhunters)

## About HeadHunters

Headhunters is a local Tshirt brand in Sabah known as Headhunter Clothing, meanwhile this is a simple webapp to manage the orders. This webapp are build on top Laravel framework. 

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

Too lazy to set it up on your machine? Here try the demo site on Heroku.

http://headhunters-demo.herokuapp.com

Try login using these email , the password is "secret" , without the quote
* johnwick@mailinator.com
* hangtuah@mailinator.com
* annabelle@mailinator.com
* grimreaper@mailinator.com
* goblin@mailinator.com
* narutouzumaki@mailinator.com
* asadi@mailinator.com
* sasuke@mailinator.com
* shufflin@mailinator.com
* killbill@mailinator.com

Please note, the database will be reset every one hour. So, every data you create and save on the demo site will perish.


## Screenshots

Well, the design is very basic. But i will put it here anyway.

### Batch
Creating a batch
![create batch](public/images/headhunter-create-batch.png?raw=true "Creating a batch")

Viewing all batch
![all batch](public/images/headhunter-all-batch.png?raw=true "Viewing all batch")

Viewing one batch
![view batch](public/images/headhunter-view-batch.png?raw=true "Viewing one batch")


### Order
Creating a order
![create order](public/images/headhunter-create-order-part-1.png?raw=true "Creating a order part 1")

![create order](public/images/headhunter-create-order-part-2.png?raw=true "Creating a order part 2")

![create order](public/images/headhunter-create-order-part-3.png?raw=true "Creating a order part 3")

![create order](public/images/headhunter-create-order-part-4.png?raw=true "Creating a order part 4")


View all order
![view order](public/images/headhunter-view-order-part-1.png?raw=true "View order part 1")

![view order](public/images/headhunter-view-order-part-2.png?raw=true "View order part 2")


## Security Vulnerabilities

If you discover a security vulnerability within this webapp, please send an e-mail to Hamzah Jamad at hamzahjamad@gmail.com. All security vulnerabilities will be promptly addressed.

## License

This webapp is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
