<?php
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
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show w" role="alert">
              Data Mahasiswa <strong>' . $_SESSION['flash']['pesan'] . '</strong>  ' . $_SESSION['flash']['aksi'] . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
           </div>';
      unset($_SESSION['flash']); // session dihapus setelah ditampilkan
    }
  }
}