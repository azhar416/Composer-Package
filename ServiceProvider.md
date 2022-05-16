# Service Provider

[Back](README.md)

## Latar belakang topik

Setelah memahami cara membuat dan menggunakan sebuah package Composer, kunci pertama dari membuat sebuah package Laravel adalah **service provider.** Service provider adalah sebuah alat untuk melakukan registrasi suatu service (berisi segala fitur seperti route, controller, dan sebagianya) terhadap package kita.

## Konsep-konsep

### Service provider

Setiap service provider men-*extend* `Illuminate/Support/ServiceProvider`, dan mengimplementasi method `register()` dan `boot()`.

`register()` merupakan method yang dapat kita isi dengan kelas-kelas supaya dapat digunakan pada service tersebut.

`boot()` merupakan method yang dijalankan setelah semua service provider telah menjalankan fungsi `register()`. Sehingga, method ini dapat digunakan untuk melakukan inisialisasi fitur yang membutuhkan service lain.

## Langkah-langkah tutorial

Tutorial ini akan menjelaskan cara membuat service provider sederhana untuk package kita.

### Langkah pertama

Buat sebuah kelas `CalculatorServiceProvider` yang men-extend `Illuminate\Support\ServiceProvider`:

```php
<?php

namespace azhar\helloworld;

use Illuminate\Support\ServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // initiate class and binding class into service container.
    }

    public function boot()
    {
        // called after all services are registered.
    }
}
```

### Langkah kedua

Kita akan meregistrasi service provider yang sudah kita buat agar dapat dilakukan *autoloading* oleh Composer. Tambahkan bagian berikut pada `composer.json`:
```json
{
    "extra": {
        "laravel": {
            "providers": [
                "azhar\\helloworld\\CalculatorServiceProvider"
            ]
        }
    }
}
```

Setelah melakukan registrasi, maka semua project yang menggunakan package kita akan dapat menggunakan apapun yang sudah kita registrasi pada service provider.