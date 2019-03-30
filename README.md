# Social Package for Laravel

[![Latest Stable Version](https://poser.pugx.org/igorgawrys/social/version)](https://packagist.org/packages/igorgawrys/social) [![Total Downloads](https://poser.pugx.org/igorgawrys/social/downloads)] (https://packagist.org/packages/igorgawrys/social)[![Latest Unstable Version](https://poser.pugx.org/igorgawrys/social/v/unstable)](//packagist.org/packages/igorgawrys/social) [![License](https://poser.pugx.org/igorgawrys/social/license)](https://packagist.org/packages/igorgawrys/social)

| **Laravel**  |  **social package** |
|---|---|
| 5.6 to 5.8  | ^0.0.1  |

## Installation

To install this package you will need
  - PHP 7.1

The best way to install this package is with the help of composer. Run
```
composer require igorgawrys/social
```

or install it by adding it to `composer.json` then run `composer update`
```
"require": {
    "igorgawrys/social": "^0.0.1",
}
```

## Setup

Once you have installed this package from the [composer](https://packagist.org/packages/igorgawrys/social), make sure to follow the below steps to configure.

To register authentication guard.

##### config/auth.php
```php
'guards' => [
    ...,
    'social' => [
        'driver' => 'session' || 'jwt',
        'provider' => 'social',
    ],
```

```php
'providers' => [
    ...,
    'social' => [
        'driver' => 'eloquent.social' || OR IS NOT WORKING 'eloquent',
        'model' => Igorgawrys\Social\User::class,
    ],
```

```php
'passwords' => [
    ...,
    'social' => [
        'provider' => 'social',
        'table' => 'password_resets',
        'expire' => 60,
    ],
```

#### Publish config file (optional)
```bash
php artisan vendor:publish --provider="MrShan0\WordpressAuth\WordpressAuthServiceProvider"
```

It will publish config file (`config/social.php`) where you can define your own connection type e.g `social`. Make sure to fill `prefix` in `config/database.php` for `` prefix in your tables if you're using prefix in wordpress tabels.

For example:
```php
'social-mysql' => [
            'driver' => 'mysql',
            'host' => env('SOCIAL_DB_HOST', '127.0.0.1'),
            'port' => env('SOCIAL_DB_PORT', '3306'),
            'database' => env('SOCIAL_DB_DATABASE', 'forge'),
            'username' => env('SOCIAL_DB_USERNAME', 'forge'),
            'password' => env('SOCIAL_DB_PASSWORD', ''),
            'unix_socket' => env('SOCIAL_DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
],
```

## Configuration

`password_resets` table (from Laravel default auth mechanism) is required to hold reset password token. If you do not have `password_resets` table then use this migration instead
```
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
```

## Extension
Alternatively, if you want to use a custom user model, you should have it extend `Igorgawrys\Social\Models\WordpressUser` and specify the name of your model in `config/auth.php` under `providers` -> `social` -> `model`.

## Recommeded is 
Use publish Model App/User this write relationships e.g

## Usage
You need to define `social` **guard** explicitly to load the driver.
### Examples
```php
// or login using email and password
Auth::guard('social')->attempt([
    'user_email' => 'demo@example.com',
    'user_pass' => 'quickbrownfox'
]);

// get user object
Auth::guard('social')->user();

// Update wordpress compatible password
$user->password = app('social')->make('new_password');
$user->save();

// logout
Auth::guard('social')->logout();
```

## Changelog

[CHANGELOG](CHANGELOG.md)

## Credits

Thanks to the community of [Laravel](https://www.laravel.com/).

## Copyright and License

Copyright (c) 2019 [Igor Gawryś](https://igorgawrys.pl/), [MIT](LICENSE) License
