<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UsersModel;

class Users extends Controller {
  protected object $users;

  public function __construct($param) {
    $this->users = new UsersModel();
    
    parent::__construct($param);
  }

  public function postUsers() {
    $this->users->add($this->body);

    return $this->users->getLast();
  }

  public function deleteUsers() {
    return $this->users->delete(intval($this->params['id']));
  }

  public function getUsers() {
    return $this->users->get(intval($this->params['id']));
  }
}
