<?php

namespace App\Controllers;

use App\Controllers\Controller;



class Session extends Controller {
  protected $session;

  public function __construct($param) {
    $this->session = session_status();

    parent::__construct($param);
  }

  public function postSession(){
    if ($this->body!=2){
      session_start();
    } else {
      session_destroy();
    }
    $this->session= session_status();
  }

  public function getSession() {
    return $this->session;
  }
}