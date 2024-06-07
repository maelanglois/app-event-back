<?php

namespace App\Models;

use PDO;
use stdClass;

class UsersModel extends SqlConnect {

    public function get() {
        $req = $this->db->prepare("SELECT * FROM users");
        $req->execute();
        
        return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();    
    }

    public function add(array $data) {
        $query = "
          INSERT INTO users (mail, password) VALUES (?, ?)
        ";
        $req = $this->db->prepare($query);
        $req->execute([
            $data['mail'],
            $data['password']
        ]);  
    }

    public function getOne($mail) {
        $req = $this->db->prepare("SELECT * FROM users WHERE mail = :mail");
        $req->execute(["mail" => $mail]);
        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function getLast() {
        $req = $this->db->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
        $req->execute();
        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }

    public function delete($id) {
        $req = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $req->execute(["id" => $id]);
        return $req->rowCount() > 0;
    }

    public function getById($id) {
        $req = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $req->execute(["id" => $id]);
        return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
    }
}
