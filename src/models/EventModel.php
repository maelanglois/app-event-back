<?php

namespace App\Models;

use \PDO;
use stdClass;

class EventModel extends SqlConnect {
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

    // public function addUserId($data) {
    //   $query = "INSERT INTO user_event (user_id, event_id) VALUES (?, ?)";
    //   $req = $this->db->prepare($query);
    //   $req->execute([
    //     $data['user_id'],
    //     $data['event_id']
    //   ]);
    // }

    public function delete(int $id) {
      $req = $this->db->prepare("DELETE FROM evenement WHERE id = :id");
      $req->execute(["id" => $id]);
    }

    public function get(int $id) {
      $req = $this->db->prepare("SELECT * FROM evenement WHERE id = :id");
      $req->execute(["id" => $id]);

      return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getAll() {
      $req = $this->db->prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS date, DATE_FORMAT(time, '%H:%i') AS time FROM evenement");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getLast() {
      $req = $this->db->prepare("SELECT * FROM evenement ORDER BY id DESC LIMIT 1");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    // public function getEventsByUserId(int $userId) {
    //   $req = $this->db->prepare("SELECT * FROM evenement JOIN user_event ON evenement.id = user_event.event_id JOIN user ON user_event.user_id = user.id WHERE user.id = :userId ");
    //   $req->execute(["userId" => $userId]);
  
    //   return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : [];
    // }
  
}
