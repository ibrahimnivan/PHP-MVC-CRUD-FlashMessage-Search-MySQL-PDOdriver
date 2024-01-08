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

  public function getubah() {
    echo json_encode($this->model('Mahasiswa_model')->getMhsById($_POST['id'])); // untuk ngambil data buat modal ubah
  }

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


}