<?php
class Mahasiswa extends Controler {
  public function index() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['mhs'] = $this->model('Mahasiswa_model')->getAllMhs();
    $this->view('templates/header', $data);
    $this->view('mahasiswa/index', $data); // data mhs
    $this->view('templates/footer');
  }
  
  public function detail($id) {
    $data['judul'] = 'Detail Mahasiswa';
    $data['mhs'] = $this->model('Mahasiswa_model')->getMhsById($id);
    $this->view('templates/header', $data);
    $this->view('mahasiswa/detail', $data); // data mhs
    $this->view('templates/footer');
  }
}