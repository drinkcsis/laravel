<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Postman
I have added folder **'postman'** into the project. There you can find postman configs for Postman to test API.

## Controllers
I have added 3 Controllers
- AuthController - For custom authorisation.
- PingPongController - For Ping-Pong task
- BookController - For books-API

## Service Providers
I have added 2 Providers
- TokenServiceProvider - it provide 2 variants of token Services (bearer and jwt)
- BookStoreServiceProvider - It provide Service for working with json-file with books

## Services
I have added 2 Services
- Token (with 2 implementations Bearer and JWT)
- BookStore

## Facades
I have added 2 Facades for Services
- BookStoreService
- TokenService

## UserProvider
I have added custom UserProvider to customize behavior of Auth::provider. Look in **app/Providers/AuthServiceProvider::boot()** and **config/auth.php::providers**

## Middlewares
I have added 2 middleware
- CustomAuth - to check is user logged in
- ExecutionTime- to add request execution time header

## config
I have added 2 config files
- books.php - for BookStoreService
- token.php - for TokenService
