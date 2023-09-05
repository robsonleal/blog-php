<?php

namespace RobsonLeal\DesbugandoBlog\Routes;

use RobsonLeal\DesbugandoBlog\Controller\Teste;

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
      header("Location: index.php");
    });

    $this->route->add('/teste', [Teste::class,"index"]);
  }
}
