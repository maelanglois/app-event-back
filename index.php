<?php

require 'vendor/autoload.php';

use App\Router;
use App\Controllers\User;
use App\Controllers\Users;
use App\Controllers\Event;
use App\Controllers\Login;
use App\Controllers\UserSession;

new Router([
  'user/:id' => User::class,
  'users' => Users::class,
  'event/:id' => Event::class,
  'event' => Event::class,
  'login' => Login::class,
  'session' => UserSession::class
]);
