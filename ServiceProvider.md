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

