<?php

namespace RobsonLeal\DesbugandoBlog\Routes;

class Route
{
  private $routes = [];

  public function add($path, $callback)
  {
    $this->routes[$path] = $callback;
  }

  public function dispatch($requestPath)
  {
    if (array_key_exists($requestPath, $this->routes)) {
      $callback = $this->routes[$requestPath];

      if (is_array($callback)) {
        $className = $callback[0];
        $methodName = $callback[1];
        $instance = new $className;
        $instance->$methodName();
      } else {
        $callback();
      }
    } else {
      foreach ($this->routes as $path => $callback) {
        $pattern = preg_replace('#\{:([a-zA-Z0-9_]+)\}#', '(?P<$1>[a-zA-Z0-9_]+)', $path);

        if (preg_match("#^$pattern$#", $requestPath, $matches)) {
          array_shift($matches);
          $indexedMatches = array_values($matches);

          if (is_array($callback)) {
            $className = $callback[0];
            $methodName = $callback[1];
            $object = new $className();
            call_user_func_array([$object, $methodName], $indexedMatches);
          } else {
            call_user_func_array($callback, $indexedMatches);
          }
          return;
        }
      }
    }
  }
}
