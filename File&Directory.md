------------------------------------
# app : menyediakan semua source yang dibutuhkan public
1. `init.php` : untuk bootsraping
## core
1. `App.php` : for routing
2. `Controler.php` : 
-- method 'view': untuk mengarahkan setiap controler dan method ke view dan templatenya
-- method 'model': untuk mengarahkan ke directori model yang dibutuhkan
3. `Constant.php` : untuk menyimpan semua konstanta agar memudahkan ketika ada perubahan konstanta alamat
-- menyimpan URL Absolut : `define('BASEURL', 'http://localhost/projects/003%20mvc/public');`
4. `Database.php` : untuk database wrapper
5. `Flasher.php` untuk flash message
## controler : mendefinisikan route
## views 
-- tampilan yang dibutuhkan setiap route(controler dan method)
## config : untuk database wrapper
## model
--  "Model" adalah komponen yang bertanggung jawab untuk mengelola data dan logika bisnis aplikasi. 
### templates : for html template easier if want to make css and apply css framework

-------------------------------------
# public : halaman awal (meninitialisasi App Class di App)
## css : dari bootsrap
## js : dari bootsrap