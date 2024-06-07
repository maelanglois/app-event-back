<?php

namespace App\Models;

use \PDO;
use stdClass;

class NewModel extends SqlConnect {
    public function add(array $data) {
      $query = "
        INSERT INTO evenement (name, place, time, date, status, price, type, image, organisateur, description)
        VALUES (:name, :place, :time, :date, :status, :price, :type, :image, :organisateur, :description)
      ";

      $req = $this->db->prepare($query);
      $req->execute($data);
    }

    public function getAll() {
      $req = $this->db->prepare("SELECT * FROM evenement");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
    }
}
