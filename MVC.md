## New Things Learned
1. BOOTSRAPING TECHNIQUE
-- `require_once '../app/init.php'` for bootstrapping technique: calling one file, and then that file will call the entire MVC application

2. capital letter at the beginning indicates a __class__
```php
 require_once 'core/App.php';
 require_once 'core/Controler.php';
require_once 'core/Constants.php';
 ```

 3. `$_GET['url']` untuk mengambil query pada url
 -- misal : index.php?url=asdasd, nilai asdasd yang akan diambil;

4. file `.htaccess` pada aplikasi PHP berperan penting dalam __mengkonfigurasi server web Apache__
-- inside htaccess file : 
// APP DIRECTORY
__Options -Indexes__ untuk memblok akses direktori jika didalam direktori tidak ada index.php

// PUBLIC DIRECTORY
__Options -Multiviews__: Disables content negotiation (MultiViews), which would otherwise allow Apache to choose the best matching resource based on the client's request.

__RewriteEngine On__: Enables the Apache mod_rewrite engine for URL rewriting.

- The following two lines __exclude existing directories__ and files from the rewrite rule
__RewriteCond %{REQUEST_FILENAME} !-d__ Checks if the requested URI is not a directory.
__RewriteCond %{REQUEST_FILENAME} !-f__ Checks if the requested URI is not a file.

- The RewriteRule __captures__ the requested URI and redirects it to a specific destination
__RewriteRule ^(.*)$ index.php?url=$1 [L]__ If the above conditions are met, this rule captures the requested URI and redirects it to index.php, passing the URI as a query parameter named "url." The [QSA] flag appends any existing query string to the redirected URL, and [L] indicates that this is the last rule to be processed.

5. $url = rtrim($_GET['url'], '/'); 
-- rtrim untuk menghapus '/' diakhir url

6. `call_user_func_array([$this->controler, $this->method], $this->params);`
-- method khusus untuk menjalankan controler dan method dan mengirimkan params
 
7. to use downloaded css from bootsrap in header template
```html  
<!-- it must using absolute path -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
```

8. to use downloaded js from bootsrap in footer template
```html  
<!-- it must using absolute path -->
<script src="<?= BASEURL; ?>/js/bootstrap.js"></script>
```

9. `define()` untuk menyimpan konstanta
-- e.g. `define('BASEURL', 'http://localhost/projects/003%20mvc/public');`

10. cara menambah gambar
--  `<img src="<?= BASEURL; ?>/img/blacknoir.jpg" width='200' class='shadow' alt="blacknoir">`

11. menggunakan data dari __model__ di home index
`<p class="lead">Halo nama saya <?= $data['nama']; ?></p>`

