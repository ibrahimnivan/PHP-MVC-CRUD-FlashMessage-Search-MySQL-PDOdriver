## New Things Learned

1. BOOTSRAPING TECHNIQUE
   -- `require_once '../app/init.php'` for bootstrapping technique: calling one file, and then that file will call the entire MVC application

2. capital letter at the beginning indicates a **class**

```php
 require_once 'core/App.php';
 require_once 'core/Controler.php';
require_once 'core/Constants.php';
```

3. `$_GET['url']` untuk mengambil query pada url
   -- misal : index.php?url=asdasd, nilai asdasd yang akan diambil;

4. file `.htaccess` pada aplikasi PHP berperan penting dalam **mengkonfigurasi server web Apache**
   -- inside htaccess file :
   // APP DIRECTORY
   **Options -Indexes** untuk memblok akses direktori jika didalam direktori tidak ada index.php

// PUBLIC DIRECTORY
**Options -Multiviews**: Disables content negotiation (MultiViews), which would otherwise allow Apache to choose the best matching resource based on the client's request.

**RewriteEngine On**: Enables the Apache mod_rewrite engine for URL rewriting.

- The following two lines **exclude existing directories** and files from the rewrite rule
  **RewriteCond %{REQUEST_FILENAME} !-d** Checks if the requested URI is not a directory.
  **RewriteCond %{REQUEST_FILENAME} !-f** Checks if the requested URI is not a file.

- The RewriteRule **captures** the requested URI and redirects it to a specific destination
  **RewriteRule ^(.\*)$ index.php?url=$1 [L]** If the above conditions are met, this rule captures the requested URI and redirects it to index.php, passing the URI as a query parameter named "url." The [QSA] flag appends any existing query string to the redirected URL, and [L] indicates that this is the last rule to be processed.

5. $url = rtrim($\_GET['url'], '/');
   -- rtrim untuk menghapus '/' diakhir url

6. `call_user_func_array([$this->controler, $this->method], $this->params);`
   -- method khusus untuk menjalankan controler dan method dan mengirimkan params

7. to use downloaded css from bootsrap in header template

```html
<!-- it must using absolute path -->
<link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css" />
```

8. to use downloaded js from bootsrap in footer template

```html
<!-- it must using absolute path -->
<script src="<?= BASEURL; ?>/js/bootstrap.js"></script>
```

9. `define()` untuk menyimpan konstanta
   -- e.g. `define('BASEURL', 'http://localhost/projects/003%20mvc/public');`

10. cara menambah gambar
    -- `<img src="<?= BASEURL; ?>/img/blacknoir.jpg" width='200' class='shadow' alt="blacknoir">`

11. menggunakan data dari **model** di home index
    `<p class="lead">Halo nama saya <?= $data['nama']; ?></p>`

12. terhubung dan query ke mysql menggunakan **PDO**

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

14. menghindari **SQL INJECTION**

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
      $this->db->bind('id', $id); //param dan value
      return $this->db->single();
    }
```

15. data-target button dan id modal harus sama

```html
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">Tambah Data Mahasiswa</button>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">...</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
```

16. INSERT DATA ke MySQL
16. 1. bikin form dengan method dan action yang benar
```html
<form action="<?= BASEURL ?>/mahasiswa/tambah" method="post">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="">
          </div>
          <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="number" class="form-control" id="nrp" name="nrp" placeholder="">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="">
          </div>

          <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <select class="form-control" id="jurusan" name="jurusan">
              <option value="tdk memilih">--pilih--</option>
              <option value="farmasi">Farmasi</option>
              <option value="kimia">Kimia</option>
              <option value="ilmu politik">Ilmu politik</option>
              <option value="sosiologi">Sosiologi</option>
              <option value="kehutanan">Kehutanan</option>
              <option value="pertanian">Pertanian</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
```
16. 2. mendefinisikan method tambah() di controler Mahasiswa.php
```php
  public function tambah() {
    if($this->model('Mahasiswa_model')->tambahDataMhs($_POST) > 0) { // jika array lebih dari 0
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    }
  }
```
16. 3. Mendefinisikan method tambahDataMhs($_POST) di Mahasiswa_model.php
```php
    public function tambahDataMhs($data) {
      $query = "INSERT INTO mahasiswa VALUES ('', :nama, :nrp, :email, :jurusan)"; //pakai binding
      $this->db->query($query); // menjalankan query
      $this->db->bind('nama', $data['nama']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('nrp', $data['nrp']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('email', $data['email']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('jurusan', $data['jurusan']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      
      $this->db->execute();

      return $this->db->rowCount();
    }
```

16. 4. mendefinisikan rowCount() di core Database.php : untuk menghitung jumlah row
```php
  public function rowCount() { // menghitung baris baru
    return $this->statement->rowCount(); // rowCount() pnya PDO;
  }
```

17. FLASH MESSAGE
17. 1. Membuat session di core>Flasher.php 
```php
class Flasher {
  public static function setFlash($pesan, $aksi, $tipe) { // static method untuk menentukan pesan flash
    $_SESSION['flash'] = [
      'pesan' => $pesan,
      'aksi' => $aksi,
      'tipe' => $tipe // jenis warna hijau = berhasil
    ];
  }

  public static function flash() { // untuk melakukan flash
    if(isset($_SESSION['flash'])) { // jika ada SESSION flash tampilkan pesan
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show w" role="alert" style="width: 520px;">
              Data Mahasiswa <strong>' . $_SESSION['flash']['pesan'] . '</strong>  ' . $_SESSION['flash']['aksi'] . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
           </div>';
      unset($_SESSION['flash']); // session dihapus setelah ditampilkan
    }
  }
}
```

17. 2. menjalankan session saat aplikasi mulai digunakan di public>index.php
```php
if( !session_id() ) { //jika tidak ada session id yang terdeteksi jalankan session
  session_start();
}
```

17. 3. Menentukan tempat ditampilkannya flash
```html
  <div class="row">
        <div class="col-lg-6">
          <?php Flasher::flash(); ?>
        </div>
  </div>
```

17. 4. mengatur flash di method controler(Mahasiswa.php)
```php
 public function tambah() {
    if($this->model('Mahasiswa_model')->tambahDataMhs($_POST) > 0) {
      Flasher::setFlash('berhasil', 'ditambahkan', 'success');
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    } else {
      Flasher::setFlash('gagal', 'ditambahkan', 'danger');
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    }
  }
```

18. DELETE DATA from MySQL
18. 1. link hapus + pop up confirmasi
```html
<a style=" color: red" href="<?= BASEURL ?>/mahasiswa/hapus/<?= $mhs['id'] ?>" class="float-right m-1"
            onclick="return confirm('are you sure?')">hapus</a>
```

18. 2. tambah method hapus() di controler Mahasiswa
```php
 public function hapus($id) {
    if($this->model('Mahasiswa_model')->hapusDataMhs($id) > 0 ) {
      Flasher::setFlash('berhasil', 'dihapus', 'success');
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    } else {
      Flasher::setFlash('gagal', 'dihapus', 'danger');
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    }
  }
  ```

18. 3. buat method hapusDataMhs() di Mahasiswa_model.php
```php
      public function hapusDataMhs($id) {
      $query = "DELETE FROM mahasiswa WHERE id = :id"; //pakai binding ':' artinya params
      $this->db->query($query); // menjalankan query
      $this->db->bind('id', $id); // param dan value, value berasal dari attribute name di 
      
      $this->db->execute();

      return $this->db->rowCount(); // kl berhasil rowCount = 1 (> 0) maka method hapus() dijalankan
    }
```

19. UPDATE DATA from MySQL
19. 1. link ubah 
+ `data-toggle data-target` sama dengan __tombol triggermodal tambah data__ 
+ `data-id`
+ `class="modalUpdate"` untuk selector JQuery
```html
 <a  id="modalUpdate" style=" color: green" href=" <?= BASEURL ?>/mahasiswa/ubah/<?= $mhs['id'] ?>" class="float-right m-1 modalUpdate" data-toggle="modal" data-target="#formModal" data-id="<?= 
          $mhs['id']; ?>">ubah</a>
```

19. 2. tambah script js baru & ubah JQuery dali slim ke mini di `footer.php`
```html
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="<?= BASEURL; ?>/js/script.js"></script>
```

19. 3. `script.js` di folder js untuk JQuery untuk __memanipulasi element__ modal tambah menjadi modal ubah
```js
$(function () {
  // ketika dokumen sudah siap fungsi ini dijalankan

  //// untuk tambah data
  $("#modalTambah").on("click", function () {
    $("#judulModal").html("Tambah Data Mahasiswa").html("Tambah data");
  });

  //// untuk ubah data
  $(".modalUpdate").on("click", function () { // harus class kl id ngga bisa lebih dri 1
    $("#judulModal").html("Ubah Data Mahasiswa");
    $(".modal-body button[type=submit]").html("Ubah data");
  });
});
```

19. 4. masih di `script.js` menggunakan __ajax untuk mengirim data id__ ke modal ubah & membuat method `getubah` di controler Mahasiswa __untuk menerima data berdasarkan id__
```js 
    // dari data-id attr
    const id = $(this).data("id");

    // untuk mengambil data by Id
    $.ajax({
      url: "http://localhost/projects/003%20mvc/public/mahasiswa/getubah",
      data: { id: id },
      method: "post",
      dataType: 'json',
      success: function (data) { // dijalankan kl success
        $('#nama').val(data.nama)
        $('#nrp').val(data.nrp)
        $('#email').val(data.email)
        $('#jurusan').val(data.jurusan)
        $('#id').val(data.id)
      },
    });
```

```php
  public function getubah() {
    echo json_encode($this->model('Mahasiswa_model')->getMhsById($_POST['id'])); // untuk ngambil data buat modal ubah
  }
```

19. 5. ketika mengclick tombol `Ubah data` di modal mengarah ke method `ubah()`
```js
    // mengubah attr action
    $('.modal-body form').attr('action', 'http://localhost/projects/003%20mvc/public/mahasiswa/ubah')
```

karena id dibutuhkan oleh method `ubah`
```html
<!-- hidden buat ubah data -->
        <input type="hidden" name="id" id="id" >
```

data yang dikirim ke method `ubah`
```js
function (data) { // dijalankan kl success
        $('#nama').val(data.nama)
        $('#nrp').val(data.nrp)
        $('#email').val(data.email)
        $('#jurusan').val(data.jurusan)
        $('#id').val(data.id)
}
```

19. 6. method `ubah()` di controler Mahasiswa
```php
  public function ubah() {
    if($this->model('Mahasiswa_model')->ubahDataMhs($_POST) > 0) {
      Flasher::setFlash('berhasil', 'diubah', 'success');
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    } else {
      Flasher::setFlash('gagal', 'diubah', 'danger');
      header('Location: ' . BASEURL . '/mahasiswa'); //redirect
      exit;
    }
  }
```

19. 7. method `ubahDataMhs($_POST)` di Mahasiswa_model.php untuk __update__ data ke MySQL
```php
    public function ubahDataMhs($data) {
      $query = "UPDATE mahasiswa SET nama = :nama, nrp = :nrp, email = :email, jurusan = :jurusan WHERE id = :id"; //pakai binding ':' artinya params
      $this->db->query($query); // menjalankan query
      $this->db->bind('nama', $data['nama']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('nrp', $data['nrp']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('email', $data['email']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('jurusan', $data['jurusan']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('id', $data['id']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      
      $this->db->execute();

      return $this->db->rowCount(); // kl berhasil > 0  method ubah + flasher dijalankan
    }
```

20. SEARCH DATA based on nama

