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

12. terhubung dan query ke mysql menggunakan __PDO__
```php
class Mahasiswa_model {
  private $dbhandler;
  private $statement;

  public function __construct() {
    // data source name
    $dsn = 'mysql:host=localhost;dbname=phpmvc'; 

    try {
      $this->dbhandler = new PDO($dsn, 'root', '');
    } catch(PDOException $e) {
      die($e->getMessage()); // menghentikan program
    }

  }

    public function getAllMhs() {
      $this->statement = $this->dbhandler->prepare('SELECT * FROM mahasiswa');
      $this->statement->execute();
      return $this->statement->fetchAll(PDO::FETCH_ASSOC); //dikembalikan sbg array assoc
    }
}
```

13. database wrapper
- mengelola database untuk berbagai model manapun

14. menghindari __SQL INJECTION__
```php
// di core Database.php
  public function bind($param, $value, $type = null) {
    if(is_null($type)) {
      switch(true) {
        case is_int($value) :
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value) :
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value) :
          $type = PDO::PARAM_NULL;
          break;
        default :
          $type = PDO::PARAM_STR;
      }
    }

    $this->statement->bindValue($param, $value, $type); // kita bind dan tidak langsung dimasukan ke query supaya terhindar dari sql injection, karena query dieksekusi setelah string dibersihkan
  }

  // di model Mahasiswa_model.php
      public function getMhsById($id) {
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id'); // id ngga langusng dimasukin dan akan kita binding untuk menghindari sql injection
      $this->db->bind('id', $id);
      return $this->db->single();
    }
  ```

