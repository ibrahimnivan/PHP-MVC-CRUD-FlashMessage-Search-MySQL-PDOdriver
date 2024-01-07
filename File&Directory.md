------------------------------------
# app : menyediakan semua source yang dibutuhkan public
## core
1. App.php : for routing
2. Controler.php : 
-- method 'view': untuk mengarahkan setiap controler dan method ke view dan templatenya
-- method 'model': untuk mengarahkan ke directori model yang dibutuhkan
3. Constant.php : untuk menyimpan semua konstanta agar memudahkan ketika ada perubahan konstanta alamat
-- menyimpan URL Absolut : `define('BASEURL', 'http://localhost/projects/003%20mvc/public');`
## controler : mendefinisikan route
## views 
-- tampilan yang dibutuhkan setiap route(controler dan method)
## model
--  "Model" adalah komponen yang bertanggung jawab untuk mengelola data dan logika bisnis aplikasi. 
### templates : for html template easier if want to make css and apply css framework

-------------------------------------
# public : halaman awal (meninitialisasi App Class di App)
## css : dari bootsrap
## js : dari bootsrap