<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
</p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# E-commerce Single Page Application Development

This Project is based on Laravel Framework

## For Frontend:
1. Tailwind Component

## E-commerce Component
1. Livewire

## Requirements:
1. Xampp 8.0.25

Clone This project in your local htdocs and run the following commands step by step

## For node modules:
1. npm install

## For generating the key:
2. php artisan key:generate

## For development:
3. npm run dev

## For Web mix:
4. npm run watch

After creating the database, rename your `.env.example` to `.env` and add your database name

## For migrating tables:
5. php artisan migrate:fresh --seed

## After that, start your server:
6. php artisan serve

## User credentials:
Email: test@example.com
Password: password

## For PayPal setup:
Add the following code in your .env file:
```plaintext
PAYPAL_MODE=
PAYPAL_SANDBOX_CLIENT_ID=
PAYPAL_SANDBOX_CLIENT_SECRET=


Create your own PayPal developer account and get the client ID and client secret.

Note: Please ensure all commands run successfully. Sometimes issues can occur due to version mismatches.

Here are some external dependencies:

Breeze: "laravel/breeze": "1.9.2" (command: composer require laravel/breeze 1.9.2)
Livewire: "livewire/livewire": "^2.12" (command: composer require laravel/livewire)
PayPal: "srmklive/paypal": "^3.0" (command: composer require srmklive/paypal)
