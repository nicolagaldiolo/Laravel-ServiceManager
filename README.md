# Laravel-HostingManager

## About
Coming soon

## Installation

Install dependencies composer and npm
```
$ composer install
$ npm install
```
Generate .env file and setup db info
```
$ cp .env.example .env
```
Generate a Key
```
$ php artisan key:generate
```
Setup link to storage folder
```
$ php artisan storage:link
```
Run migration and seed
```
$ php artisan migrate:fresh --seed
```
## Login with demo user
email: demouser@example.com  
password: password
