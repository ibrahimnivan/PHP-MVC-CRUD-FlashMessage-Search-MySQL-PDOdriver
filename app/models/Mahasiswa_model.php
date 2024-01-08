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
      $this->db->bind('id', $id);
      return $this->db->single();
    }
}