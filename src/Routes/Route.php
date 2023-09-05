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
      // TODO aqui vai a página de not found
    }
  }
}
