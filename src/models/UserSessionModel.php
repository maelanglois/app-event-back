<?php

namespace App\Models;

use \PDO;
use stdClass;

class UserSessionModel extends SqlConnect {
    public function add($data) {
      $query = "
        INSERT INTO evenement (name, place, time, date, status, price, type, image, organisateur, description)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ";

      $req = $this->db->prepare($query);
      $req->execute([
        $data['name'],
        $data['place'],
        $data['time'],
        $data['date'],
        $data['status'],
        $data['price'],
        $data['type'],
        $data['image'],
        $data['organisateur'],
        $data['description']
      ]);
    }

    

    public function addUserId($data) {
      $query = "INSERT INTO user_event (user_id, event_id) VALUES (?, ?)";
      $req = $this->db->prepare($query);
      $req->execute([
        $data['user_id'],
        $data['event_id']
      ]);
    }

    // public function delete(int $id) {
    //   $req = $this->db->prepare("DELETE FROM evenement WHERE id = :id");
    //   $req->execute(["id" => $id]);
    // }

    public function getBySession($session_id) {
      $req = $this->db->prepare("SELECT id FROM users WHERE session_id = :id");
      $req->execute([
        'id' => $session_id
      ]);

      return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getAll() {
      $req = $this->db->prepare("SELECT * FROM users");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
    }

    // public function getLast() {
    //   $req = $this->db->prepare("SELECT * FROM evenement ORDER BY id DESC LIMIT 1");
    //   $req->execute();

    //   return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    // }
}
