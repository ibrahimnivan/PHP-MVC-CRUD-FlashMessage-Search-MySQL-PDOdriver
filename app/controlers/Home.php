<?php
class Home extends Controler{
  public function index() {
    $data['judul'] = 'Home';
    $data['nama'] = $this->model('User_model')->getUser();
    $this->view('templates/header', $data); // data untuk judul halaman
    $this->view('home/index', $data); // untuk data nama
    $this->view('templates/footer');
  }
}