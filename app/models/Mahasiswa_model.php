<?php
class Mahasiswa_model {
  private $mhs = [
    [
      "nama" => "Homelander",
      "nrp" => "1111111",
      "email" => "homelander@gmail.com",
      "jurusan" => "teknik sipil"
    ],
    [
      "nama" => "Queen Meave",
      "nrp" => "2222222",
      "email" => "queenmeave@gmail.com",
      "jurusan" => "teknik elektro"
    ],
    [
      "nama" => "A-Train",
      "nrp" => "3333333",
      "email" => "atrain@gmail.com",
      "jurusan" => "teknik kelautan"
    ],
    [
      "nama" => "Black Noir",
      "nrp" => "4444444",
      "email" => "blacknoir@gmail.com",
      "jurusan" => "kehutanan"
    ],
    [
      "nama" => "Willian Butcher",
      "nrp" => "5555555",
      "email" => "wilianbutcher@gmail.com",
      "jurusan" => "managemen"
    ],
    ];

    public function getAllMhs() {
      return $this->mhs;
    }
}