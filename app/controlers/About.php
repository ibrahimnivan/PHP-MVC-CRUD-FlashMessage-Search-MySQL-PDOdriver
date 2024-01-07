<?php
class About extends Controler {
  public function index($nama = 'Ivan', $pekerjaan = 'Web developer', $umur = 20) { // parames di url
    $data['judul'] = 'About Index';
    $data['nama'] = $nama;
    $data['pekerjaan'] = $pekerjaan;
    $data['umur'] = $umur;
    $this->view('templates/header', $data); // data = kirim judul halaman
    $this->view('about/index', $data);
    $this->view('templates/footer');
  }
  public function page() {
    $data['judul'] = 'About page';
    $this->view('templates/header', $data); // data = kirim judul halaman
    $this->view('about/page');
    $this->view('templates/footer');
  }
}