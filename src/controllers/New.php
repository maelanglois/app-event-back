<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\NewtModel;

class New extends Controller {
  protected object $new;

  public function __construct($param) {
    $this->new = new NewModel();

    parent::__construct($param);
  }

  public function postNew() {
    $this->new->add($this->body);
  }

  public function get() {
    $this->new->getAll($this->body);
  }
}
