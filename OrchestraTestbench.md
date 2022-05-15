# Orchestra Testbench & Testing

[Back](README.md)

## Latar belakang topik

Dalam pembuatan sebuah package Laravel kita akan membutuhkan akses ke komponen-komponen bawaan dari Laravel (Illuminate). Kita tidak menggunakan project Laravel secara langsung sebagai dependency, oleh karena itu kita dapat mengggunakan sebuah package untuk membantu, [Orchestra Testbench](https://github.com/orchestral/testbench).

## Konsep-konsep

### Orchestra Testbench

Testbench adalah sebuah package Composer dengan tujuan utama untuk mendukung proses testing dari pengembangan package Laravel.

Pada Testbench terdapat dua direktori yang penting untuk diketahui, `/laravel` dan `/src`. Apabila diperhatikan, direktori `/laravel` memuat struktur yang sama dengan sebuah project Laravel. Ini yang akan kita gunakan untuk membantu mengembangkan package Laravel. Direktori `/src` berisi semua modul dan peralatan yang dapat digunakan untuk melakukan testing.

Untuk keperluan testing, kita akan *extend* kelas `TestCase` milik Testbench, yang akan dibaca oleh Testbench. Untuk setiap kelas `TestCase`, Testbench akan menjalankan sebuah aplikasi Laravel dengan menggunakan namespace yang diarahkan ke direktori `/laravel` tadi.

### Kompatibilitas

Setiap versi Testbench dibuat untuk versi Laravel yang berbeda, seperti tabel berikut.

| Laravel | Orchestra Testbench |
| -|-|
| 8.x | 6.x |
| 7.x | 5.x |
| 6.x | 4.x |

Selengkapnya dapat dilihat di [dokumentasi Orchestra Testbench](https://packages.tools/testbench/getting-started/introduction.html#version-compatibility).

### Testing

Untuk unit/feature testing sendiri akan dibantu dengan package `PHPUnit`, yang akan didemonstrasikan pada tutorial. Struktur direktori untuk testing umumnya sebagai berikut:

```yaml
- src/
  - HelloWorld.php # kode sumber package
- tests/
  - Feature/ # feature test
  - Unit/ # unit test
  - TestCase.php # berisi pengaturan tambahan dari testing seperti setting up
```

`TestCase.php` akan mengimplementasikan beberapa fungsi berikut dari `\Orchestra\Testbench\Testcase`:
* `getPackageProviders()`: untuk mempersiapkan service provider yang kita punya
* `getEnvironmentSetup()`: dijalankan di tahap awal jalannya aplikasi
* `setUp()`: fungsi yang dipanggil sebelum setiap test

## Langkah-langkah tutorial

Pada tutorial ini menggunakan Testbench 7.4.

Kita akan langsung meneruskan implementasi dari tutorial topik sebelumnya.

### Langkah pertama 