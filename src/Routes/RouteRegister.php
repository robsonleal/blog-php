<?php

namespace RobsonLeal\DesbugandoBlog\Routes;

// Debug config
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

    $this->route->add('/postagens', [PostagemController::class, "index"]);

    $this->route->add('/postagens/{:id}', [PostagemController::class, "show"]);

    $this->route->add('/postagens/{:id}/editar', [PostagemController::class, "edit"]);

    $this->route->add('/postagens/salvar', [PostagemController::class, "save"]);

    $this->route->add('/postagens/{:id}/deletar', [PostagemController::class, "delete"]);
  }
}
