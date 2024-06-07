<?php

namespace App;

class Router {
  protected array $routes;
  protected string $url;

  public function __construct(array $routes) {
    $this->routes = $routes;
    $this->url = $_SERVER['REQUEST_URI'];
    $this->run();
  }

  protected function extractParams($url, $rule) {
    (array) $params = [];
    (array) $urlParts = explode('/', trim($url, '/'));
    (array) $ruleParts = explode('/', trim($rule, '/'));

    foreach ($ruleParts as $index => $rulePart) {
      if (strpos($rulePart, ':') === 0 && isset($urlParts[$index])) {
        $paramName = substr($rulePart, 1);
        $params[$paramName] = $urlParts[$index];
      }
    }

    return $params;
  }

  protected function matchRule($url, $rule) {
    (array) $urlParts = explode('/', trim($url, '/'));
    (array) $ruleParts = explode('/', trim($rule, '/'));

    if (count($urlParts) !== count($ruleParts)) {
      return false;
    }

    foreach ($ruleParts as $index => $rulePart) {
      if ($rulePart !== $urlParts[$index] && strpos($rulePart, ':') !== 0) {
        return false;
      }
    }

    return true;
  }

  protected function run() {
    (bool) $is404 = true;
    (string) $url = parse_url($this->url, PHP_URL_PATH);

    foreach ($this->routes as $route => $controller) {
      if ($this->matchRule($url, $route)) {
        (array) $params = $this->extractParams($url, $route);
        new $controller($params);

        $is404 = false;

        break;
      }
    }

    if ($is404) {
      header('Access-Control-Allow-Origin: *');
      header('Content-type: application/json; charset=utf-8');
      header('HTTP/1.0 404 Not Found');

      echo json_encode([
        'code' => '404',
        'message' => 'Not Found'
      ]);
    }
  }
}