# Site access token for Laravel apps

[![Latest Stable Version](http://poser.pugx.org/damianchojnacki/access-token/v)](https://packagist.org/packages/damianchojnacki/access-token) [![Total Downloads](http://poser.pugx.org/damianchojnacki/access-token/downloads)](https://packagist.org/packages/damianchojnacki/access-token) [![License](http://poser.pugx.org/damianchojnacki/access-token/license)](https://packagist.org/packages/damianchojnacki/access-token) [![PHP Version Require](http://poser.pugx.org/damianchojnacki/access-token/require/php)](https://packagist.org/packages/damianchojnacki/access-token)

This package protects site from viewing by regular users. Only the ones who know unique token can access site.

**WARNING! This package DOES NOT ensure high level of protection! It is intended to prevent viewing site by regular users. For real authentication use proper package like Laravel Passport.**

## Requirements

It requires PHP 7.4+ and Laravel 5.8+.

## Installation

1. Install package using composer:

```bash
composer require damianchojnacki/access-token
```

2. Create .env configuration variables:

```dotenv
ACCESS_TOKEN=
ACCESS_EXPIRATION=
```

You can specify here your access token and expiration time in minutes (default 1 day).

## Usage

To make usage easier there is helper middleware that validates token. If it was not found 403 error is thrown. 

You can guard whole site by placing middleware into Kernel.php file

```php
protected $middleware = [
    \Damianchojnacki\AccessToken\CheckAccessToken::class,
];
```

If you want to guard specific route you can define named middleware:

```php
protected $routeMiddleware = [
    'access-token' => \Damianchojnacki\AccessToken\CheckAccessToken::class,
];
```

There is also command for generating new token:

```bash
php artisan access-token:generate
```

```bash                                                                                                                       
[OK] Access token saved to .env file. You can now access your site by visiting url below:                                                                                                                                                          

https://example.com?token=3md3Q8sLYNMCVrMvqaw67FSnUvC7d9gN
```

## License
The MIT License (MIT). Please see License File for more information.
