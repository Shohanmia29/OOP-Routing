<?php
class Router {
  public static $routes;
  public static function get($url, $view) {
    self::$routes[$url] = $view;
  }
  public static function run ($url) {
    if (array_key_exists($url, self::$routes)) {
      return self::$routes[$url];
    } else {
      return 'views/notfound.php';
    }
  }
}

