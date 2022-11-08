<?php
require_once 'libs/Router.php';
require_once './app/controller/auto.controller.php';

$router = new Router();

$router->addRoute('autos', 'GET', 'autoController', 'showAll');
$router->addRoute('autos', 'POST', 'autoController', 'addAutos');
$router->addRoute('autos/:ID', 'GET', 'autoController', 'showAutos');
$router->addRoute('autos/:ID', 'DELETE', 'autoController', 'delete');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

