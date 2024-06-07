<?php

namespace App\Models;

use \PDO;
use stdClass;

class LoginModel extends SqlConnect {
    public function add($data) {
      $query = "
        INSERT INTO evenement (mail, password)
        VALUES (?, ?)
      ";

      $req = $this->db->prepare($query);
      $req->execute([
        $data['mail'],
        $data['password']
      ]);
    }

    public function getByMail($mail){
        $req = $this->db->prepare("SELECT * FROM users WHERE mail = :mail");
        $req->execute(["mail" => $mail]);

        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : false;
    }

    public function updateSessionId(string $session_id, $mail) {
        $query = "UPDATE users SET session_id = :session_id WHERE mail = :mail";
        $req = $this->db->prepare($query);
        $req->execute([
          'session_id' => $session_id,
          'mail' => $mail
        ]);
      }

    public function delete(int $id) {
      $req = $this->db->prepare("DELETE FROM users WHERE id = :id");
      $req->execute(["id" => $id]);
    }

    public function get(int $id) {
      $req = $this->db->prepare("SELECT * FROM users WHERE id = :id");
      $req->execute(["id" => $id]);

      return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getAll() {
      $req = $this->db->prepare("SELECT * FROM users");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getLast() {
      $req = $this->db->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }
}
