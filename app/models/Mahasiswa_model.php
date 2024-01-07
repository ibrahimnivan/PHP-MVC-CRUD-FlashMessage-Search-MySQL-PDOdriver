<?php
class Mahasiswa_model {
  private $dbhandler;
  private $statement;

  public function __construct() {
    // data source name
    $dsn = 'mysql:host=localhost;dbname=phpmvc'; 

    try {
      $this->dbhandler = new PDO($dsn, 'root', '');
    } catch(PDOException $e) {
      die($e->getMessage()); // menghentikan program
    }

  }

    public function getAllMhs() {
      $this->statement = $this->dbhandler->prepare('SELECT * FROM mahasiswa');
      $this->statement->execute();
      return $this->statement->fetchAll(PDO::FETCH_ASSOC); //dikembalikan sbg array assoc
    }
}