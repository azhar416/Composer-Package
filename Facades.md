# Facades

[Kembali](readme.md)

## Latar belakang topik

 Sebelumnya kita selalu berinteraksi dengan fitur-fitur laravel menggunakan dependency injection,namun kadang ada ketika kita tidak bisa mendapatkan object Application, misal kita membuat kode di class yang bukan bawaan fitur laravel, pada kasus seperti ini, facades sangat membantu 
 
 ## Konsep 

 Facades adalah class yang menyediakan static akses ke fitur di Service Container atau Application. Laravel menyediakan banyak sekali class Facades.

 Facades hanya digunakan jika memang dibutuhkan saja, Apabila bisa dilakukan dengan dependency injection, maka gunakanlah selalu depedency injection 
 
 karena terlalu banyak menggunakan Facades akan membuat kita tidak sadar bahwa sebuah class banyak sekali memiliki depedency jika menggunakan dependency injection, kita bisa sadar dengan banyaknya parameter yang terdapatt di constructor


 