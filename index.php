<?php
require_once __DIR__ . '/vendor/autoload.php';

use RobsonLeal\DesbugandoBlog\Routes\Route;
use RobsonLeal\DesbugandoBlog\Routes\RouteRegister;

session_start();

$route = new Route();
$routeRegister = new RouteRegister($route);
$routeRegister->register();
$requestPath = $_SERVER['REQUEST_URI'];
$route->dispatch($requestPath);
