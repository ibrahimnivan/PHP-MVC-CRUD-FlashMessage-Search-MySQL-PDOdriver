<?php

class Database {
  // private $host = DB_HOST;
  // private $user = DB_USER;
  // private $pass = DB_PASS;
  // private $db_name = DB_NAME;

  private $db_handler;
  private $statement;

  public function __construct() {
    // data source name
    $dsn = 'mysql:host=localhost;dbname=phpmvc'; 

    $option = [
      PDO::ATTR_PERSISTENT => true, // membuat koneksi terjaga terus
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // dalam mode error tampilkan exeption
    ];

    try {
      $this->db_handler = new PDO($dsn, 'root', '', $option );
    } catch(PDOException $e) {
      die($e->getMessage()); // menghentikan program
    }

  }

  public function query($query) {
    $this->statement = $this->db_handler->prepare($query);
  }

  public function bind($param, $value, $type = null) {
    if(is_null($type)) { //Jika belum diatur ($type is null), maka dilakukan pengecekan tipe data nilai ($value).
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

  public function execute() {
    $this->statement->execute(); // for executing the prepared SQL statement using PDO's 
  }

  public function resultSet() { // kl pengen datanya banyak
    $this->execute();
    return $this->statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single() { // kl datanya satu
    $this->execute();
    return $this->statement->fetch(PDO::FETCH_ASSOC);
  }

  public function rowCount() { // menghitung baris baru
    return $this->statement->rowCount(); // rowCount() pnya PDO;
  }

}