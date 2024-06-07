<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UserSessionModel;

class UserSession extends Controller {
  protected object $userSession;

  public function __construct($param) {
    $this->userSession = new UserSessionModel();

    parent::__construct($param);
  }

  public function postUserSession() {
     return $this->userSession->getBySession($this->body['id']); 
  }

  public function getUserSession() {
    return $this->userSession->addAll();
  }

  public function deleteUserSession() {
    return $this->userSession->delete(intval($this->params['id']));
  }
}