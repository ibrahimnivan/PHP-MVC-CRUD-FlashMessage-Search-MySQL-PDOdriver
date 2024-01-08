<?php 
if( !session_id() ) { //jika tidak ada session id yang terdeteksi jalankan session
  session_start();
}

require_once '../app/init.php'; // Bootsraping

$app = new App; // instansiasi class App