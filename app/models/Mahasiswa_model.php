<?php
class Mahasiswa_model {
  private $table = 'mahasiswa'; // table yang digunakan di db phpmvc
  private $db; // untuk menampung class Database

  public function __construct() {
    $this->db = new Database; // intansiasi (agar langsung bisa dipake methodnya di controler)
  }
    public function getAllMhs() {
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet(); // tampilin semua data
    }
    
    public function getMhsById($id) {
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id'); // id ngga langusng dimasukin dan akan kita binding untuk menghindari sql injection
      $this->db->bind('id', $id); // param dan value
      return $this->db->single();
    }

    public function tambahDataMhs($data) {
      $query = "INSERT INTO mahasiswa VALUES ('', :nama, :nrp, :email, :jurusan)"; //pakai binding ':' artinya params
      $this->db->query($query); // menjalankan query
      $this->db->bind('nama', $data['nama']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('nrp', $data['nrp']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('email', $data['email']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      $this->db->bind('jurusan', $data['jurusan']); // param dan value, value berasal dari attribute name di element input (nama harus sama)
      
      $this->db->execute();

      return $this->db->rowCount();
    }
    public function hapusDataMhs($id) {
      $query = "DELETE FROM mahasiswa WHERE id = :id"; //pakai binding ':' artinya params
      $this->db->query($query); // menjalankan query
      $this->db->bind('id', $id); // param dan value, value berasal dari attribute name di 
      
      $this->db->execute();

      return $this->db->rowCount(); // kl berhasil rowCount = 1 (> 0) maka method hapus() + flasher dijalankan
    }

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
  }