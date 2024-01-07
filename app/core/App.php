<?php

class App
{
  protected $controler = 'Home'; // default
  protected $method = 'index'; // default
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseURL();

    // CONTROLER
    if (!empty($url)) {
      if (file_exists('../app/controlers/' . $url[0] . '.php')) {
        $this->controler = $url[0];   // menimpa controler default
        unset($url[0]); // menghilangkan controler dari element array
      }
    }

    require_once '../app/controlers/' . $this->controler . '.php'; // ambil controler baru
    $this->controler = new $this->controler; // instansiasi

    // METHOD
    if (isset($url[1])) { // jika ada method tertulis di url
      if (method_exists($this->controler, $url[1])) { // apakah method ada di dalam controler
        $this->method = $url[1]; // kl ada kita timpa
        unset($url[1]); // hapus dari url
      }
    }

    // PARAMS
    if (!empty($url)) {
      $this->params = array_values($url); // untuk mengembalikan semua nilai dalam suatu array

    }


    // Jalankan controler & method, serta kirimkan params jika ada
    call_user_func_array([$this->controler, $this->method], $this->params);
  }

  public function parseURL()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/'); // rtrim untuk menghilangkan '/' diakhir url
      $url = filter_var($url, FILTER_SANITIZE_URL); // supaya url bersih dari charakter aneh
      $url = explode('/', $url); // explode untuk memecah url berdasarkan '/' (jadi array) 
      return $url;
    }
  }
}