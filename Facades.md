# Facades

[Kembali](readme.md)

## Latar belakang topik

 Sebelumnya kita selalu berinteraksi dengan fitur-fitur laravel menggunakan dependency injection,namun kadang ada ketika kita tidak bisa mendapatkan object Application, misal kita membuat kode di class yang bukan bawaan fitur laravel, pada kasus seperti ini, facades sangat membantu 
 
 ## Konsep 

 Facades adalah class yang menyediakan static akses ke fitur di Service Container atau Application. Laravel menyediakan banyak sekali class Facades.

 Facades hanya digunakan jika memang dibutuhkan saja, Apabila bisa dilakukan dengan dependency injection, maka gunakanlah selalu depedency injection 
 
 karena terlalu banyak menggunakan Facades akan membuat kita tidak sadar bahwa sebuah class banyak sekali memiliki depedency jika menggunakan dependency injection, kita bisa sadar dengan banyaknya parameter yang terdapatt di constructor

## Langkah Tutorial

Pada tutorial ini, kita akan mencoba untuk membuat kelas kalkulator untuk package kita dan kita akan membuat kelas ini sebagai sebuah Facade.

### Langkah pertama

Pada directory `/src` kita akan membuat kelas `kalkulator.php` yang memiliki method add(), subtract(), dan clear(). Semua method nantinya akan mereturn objectnya sendiri agar kita dapat menggunakannya secara functional

```php
<?php

namespace yusuf\HelloWorld;

class Calculator
{
    private $result;

    public function __construct()
    {
        $this->result = 0;
    }

    public function add(int $value)
    {
        $this->result += $value;
        return $this;
    }

    public function subtract(int $value)
    {
        $this->result -= $value;
        return $this;
    }

    public function clear()
    {
      $this->result = 0;
      return $this;
    }

    public function getResult()
    {
        return $this->result;
    }
}
```

### Langkah kedua

Pada direktori `src/Facades` kita membuat kelas facade yang melakukan extends kelas `Illuminate\Support\Facades\Facade`.

```php
<?php

namespace yusuf\HelloWorld\Facades;

use Illuminate\Support\Facades\Facade;

class Calculator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'calculator';
    }
}
```
Sekarang, kita bisa mengakses facade calculator dengan mengimport namespace use `yusuf\HelloWorld\Facades\Calculator`;.

### Langkah ketiga

Kita melakukan register binding service container kita dengan mengakses class  `CalculatorServiceProvider.php` pada direktori `src/`

```php
<?php

namespace yusuf\HelloWorld;

use Illuminate\Support\ServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('calculator', function ($app) {
            return new Calculator();
        });
    }

    ...
}
```
sehingga hasil nya
```php
<?php

namespace yusuf\HelloWorld;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use maximuse\HelloWorld\Console\InstallHelloWorld;
use maximuse\HelloWorld\Providers\EventServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('calculator', function ($app) {
            return new Calculator();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'helloworld');
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallHelloWorld::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('helloworld.php')
            ], 'config');
        }

        if (!class_exists('CreateHistoriesTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_histories_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_histories_table.php')
            ], 'migrations');
        }

        Route::group($this->routeConfiguration(), function() {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'helloworld');
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('helloworld.prefix'),
            'middleware' => config('helloworld.middleware')
        ];
    }
}

```
### Langkah Keempat

Laravel juga memungkinkan kita untuk mendaftarkan alias yang dapat meregister facade di root namespace :O. Kita dapat mendefine alias tersebut pada file composer.json kita seperti berikut.

```json
{
    ...

    "extra": {
        "laravel": {
            "providers": [
                "yusuf\\HelloWorld\\CalculatorServiceProvider"
            ],
            "aliases": {
                "Calculator": "yusuf\\HelloWorld\\Facades\\Calculator"
            }
        }
    }
}
```
Tampilan `Composer.json` sebagai berikut

```json
{
    "name": "YusufA/hello-composer",
    "description": "Simple hello world Composer package.",
    "type": "library",
    "authors": [
        {
            "name": "Yusuf Anfasya",
            "email": "yanfasya12@gmail.com"
        }
    ],
    "license": "MIT",
    "require": {},
    "require-dev": {
        "orchestra/testbench": "6.0",
        "phpunit/phpunit": "^9.5"
    },
    "autoload": {
        "psr-4": {
            "yusuf\\HelloWorld\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "yusuf\\HelloWorld\\Tests\\": "tests/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "yusuf\\HelloWorld\\CalculatorServiceProvider"
            ],
            "aliases": {
                "Calculator": "yusuf\\HelloWorld\\Facades\\Calculator"
            }
        }
    }
}
```
Dengan begitu, kita tidak perlu mengimport untuk dapat menggunakan facade kita karena sudah bisa diakses dari namespace root.

 