<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

use RobsonLeal\DesbugandoBlog\Routes\Route;
use RobsonLeal\DesbugandoBlog\Routes\RouteRegister;

$route = new Route();
$routeRegister = new RouteRegister($route);
$routeRegister->register();
$requestPath = $_SERVER['REQUEST_URI'];
$route->dispatch($requestPath);
