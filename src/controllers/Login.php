<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\LoginModel;

class Login extends Controller {
  protected object $login;

  public function __construct($param) {
    $this->login = new LoginModel();

    parent::__construct($param);
  }

  public function postLogin() {
    $mail = $this->body['mail'];
    $password = $this->body['password'];
    $data = $this->login->getByMail($mail);
    if($data['password'] == $password){
        session_start();
        $session_id = session_id();
        $this->login->updateSessionId($session_id, $mail);
        return $session_id;
    } else{
        session_destroy();
        return false;
    }
  }

  public function getLogin() {
    session_start();
    return session_id();
  }

  public function deleteLogin() {
    return $this->login->delete(intval($this->params['id']));
  }

  public function get() {
    return $this->login->getAll();
  }
}