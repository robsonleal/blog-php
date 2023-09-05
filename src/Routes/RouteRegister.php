<?php

namespace RobsonLeal\DesbugandoBlog\Routes;

use RobsonLeal\DesbugandoBlog\Controller\PostagemController;

class RouteRegister
{
  private $route;

  public function __construct(Route $route)
  {
    $this->route = $route;
  }

  public function register()
  {
    $this->route->add('/', function () {
      header("Location: /postagens");
    });

    $this->route->add('/postagens', [PostagemController::class,"index"]);
  }
}
