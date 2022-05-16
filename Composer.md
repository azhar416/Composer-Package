# Composer

[Back](README.md)

## Latar belakang topik

Sebelum masuk ke pembahasan membuat package Laravel, ada beberapa konsep yang perlu dipelajari terlebih dahulu, terutama terkait dengan package. Apa itu package, apa arti dari mengembangkan sebuah "Laravel package"?

Kebutuhan untuk didirikannya suatu package management dimulai dari semakin rumit dan besarnya aplikasi yang dibuat oleh software developer. Dengan adanya package yang bisa digunakan sebagai dependency atau prasyarat, maka seorang developer tidak perlu membuat ulang fungsionalitas yang sudah pernah dibuat oleh orang lain secara terstruktur:

> *"Don't reinvent the wheel."*

Dasar-dasar dari metode distribusi package di PHP akan menjadi dasar pemahaman untuk membentuk sebuah package dengan bahasa pemrograman PHP, bahkan di luar bahasan kerangka kerja Laravel.

## Konsep-konsep

### Pengertian Composer

Composer merupakan package manager untuk bahasa pemrograman PHP. Dengan adanya Composer, maka pengembangan dan penggunaan package PHP dapat distandardisasi sehingga mengikuti format yang sama.

Contoh package manager dengan repository paling umum pada bahasa pemrograman lain:

 | Bahasa Pemrograman|Package Manager|Package Repository|
 | -|-|-|
 | PHP|Composer|Packagist|
 | Python|pip|Python Package Index (PyPI)|
 | JavaScript|Node Package Manager (npm)|npm repository|
 | Ruby|Ruby Bundler|RubyGems|

### Struktur umum package Composer

```yaml
- src/ # Subfolder berisi kode program
- tests/ # Subfolder untuk semua kebutuhan testing
- composer.json # Konfigurasi package Composer
```

### Syntax `composer.json`

File `composer.json` berisi semua konfigurasi yang dibutuhkan untuk package yang kita buat, dalam [notasi JSON](https://www.json.org/json-en.html). Secara lengkapnya, opsi pengaturan yang bisa dimasukkan pada file ini dapat dilihat di [dokumentasi resmi Composer](https://getcomposer.org/doc/04-schema.md).

Adapun beberapa elemen yang paling sering digunakan sebagai berikut:

| Nama|Keterangan|
| -|-|
| `name`|Nama package|
| `description`|Deskripsi package|
| `type`|Tipe package, umumnya library atau project.|
| `authors`|Pengembang package|
| `require`|Berisi package-package lain yang dibutuhkan package ini.|
| `require-dev`|Sama seperti `require` namun berlaku untuk lingkungan pengembangan. Umumnya berisi library testing seperti PHPUnit.|
| `autoload`|Untuk [autoloading](https://www.php.net/autoload) kode sumber oleh PHP saat runtime.|
| `autoload-dev`|Sama seperti `autoload` namun berlaku untuk lingkungan pengembangan. Umumnya package testing dilakukan autoloading di bagian ini.|
| `scripts`|Untuk menjalankan perintah tertentu atau memanggil fungsi PHP pada tahap tertentu instalasi/penggunaan.|
| `extra`|Data tambahan yang mungkin dibutuhkan oleh perintah pada `scripts`.|


## Langkah-langkah tutorial

Untuk tutorial kita akan mencoba membuat sebuah package composer dan men-publish package tersebut pada Packagist.

### Langkah pertama

Silakan mendaftar terlebih dahulu pada [Packagist](https://packagist.org/). Pastikan juga anda sudah memiliki akun repository git public (mis. [GitHub](https://github.com/)).

Buat sebuah folder sebagai root dari package yang ingin dibuat.

### Langkah kedua

Buka terminal yang mengarah ke folder yang telah kalian buat dan ketikkan 

> composer init

Dengan menggunakan `composer init`, folder tersebut akan secara otomatis menjadi sebuah directory composer.

Saat mengeksekusi `composer init`, akan ada beberapa pertanyaan yang akan secara otomatis mengatur directory yang dibuat. Kalian dapat mengisi sesuai dengan kebutuhan. 

Contoh : 

```
Package name (<vendor>/<name>) [msi/composer-test]: azhar416/composer-test (PASTIKAN VENDOR ADALAH NAMA PACKAGIST KALIAN)
Description []: Simple hello world Composer package.
Author [azhar416 <rar.azhar.416@gmail.com>, n to skip]: <Enter>
Minimum Stability []: <Enter>
Package Type (e.g. library, project, metapackage, composer-plugin) []: <Enter>
License []: MIT

Would you like to define your dependencies (require) interactively [yes]? n
Would you like to define your dev dependencies (require-dev) interactively [yes]? n
Add PSR-4 autoload mapping? Maps namespace "Azhar416\Composer-Test" to the entered relative path. [src/, n to skip]: <Enter>

Do you confirm generation [yes]? <Enter>
```

Setelah selesai maka akan terbebtuk file `composer.json` dan 2 buah directory `src` dan `vendor`.

### Langkah ketiga

Kita dapat memulai membuat aplikasi kita pada directory `/src`.

`src/HelloWorld.php`:

```php
<?php
    namespace azhar\helloworld;
    
    class HelloWorld
    {
        public function halo()
        {
            return "Halo!";
        }
    }
?>
```

### Langkah Keempat

Jika kita membuka file `composer.json`, 

```json
{
    "autoload": {
        "psr-4": {
            "azhar\\helloworld\\": "src/"
        }
    },
}
```

`autoload` disana digunakan agar source code kita dapat diakses oleh project lain yang nantinya akan menggunakan library kita.

`"azhar\\helloworld\\": "src/"` baris ini berarti kita memberikan namespace yaitu `azhar/helloworld` pada folder `/src`. 

### Langkah kelima

Masukkan directory composer yang telah dibuat kedalam repository git.

Buat sebuah repository baru pada github dan hubungkan dengan composer yang akan di push.

```
git init
git remote add origin <url>
git add .
git commit -m "initial commit"
git push -u origin master
```

Setelah repository di push, masukkan Repository tersebut ke dalam Packagist bagian [Submit](https://packagist.org/packages/submit).

Apabila semua langkah sudah diikuti dengan baik, maka package anda akan terpublish dan untuk menggunakan dapat dengan perintah berikut pada project baru, tentunya dengan username sesuai dengan akun masing-masing:

```
composer require azhar416/composer-test
```

### Langkah keenam

Untuk menguji package, dapat dilakukan dengan menggunakan project laravel yang sudah ada ataupun membuat project composer baru.

Menggunakan project laravel :

Pertama kita nyalakan project laravel.

```
php artisan serve
```

Lalu kita membuat `view` dan jangan lupa untuk `route`nya.

Pada `/resources/views/composer.blade.php` :
```php
<?php
require_once '[path]\[to]\vendor\autoload.php';
use azhar\helloworld\HelloWorld;

$hello_world = new HelloWorld();

echo $hello_world->halo();
?>
```

Pada `web.php` :
```php
Route::get('/halo', function () {
    return view('composer');
});
```

**Jangan lupa untuk mengganti path pada `require_once`**

### Langkah Ketujuh

Akses `view : composer.blade.php` maka akan keluar output 

> Halo!

pada halaman tersebut.