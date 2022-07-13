Steps to make the project working.

prerequisite : PHP 8.0.2

I have used `Laravel` framework. Laravel has inbuilt command line interface called as `Artisan`. Artisan provides many helpful commands to to build the application. Also, user can create their own command for a command line utility.  

1. git clone https://github.com/vivek-tankaria/basassignment.git

2. Execute `composer install` command in terminal

3. To check the artisan CLI command created to generate the payment report execute  `php artisan list | grep 'getpaymentdates'` command in Terminal. 

4. To generate the report execute `php artisan command:getpaymentdates {FILENAME.csv}`