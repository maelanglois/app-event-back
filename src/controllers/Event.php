<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\EventModel;

class Event extends Controller {
  protected object $event;

  public function __construct($param) {
    $this->event = new EventModel();

    parent::__construct($param);
  }

  public function postEvent() {
    $this->event->add($this->body);
    // $this->event->addUserId($this->body);

    return $this->event->getLast();
  }

  public function deleteEvent() {
    return $this->event->delete(intval($this->params['id']));
  }

  public function getEvent() {
    return $this->event->getAll();
  }
}
