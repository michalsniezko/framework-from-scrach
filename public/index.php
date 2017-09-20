<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$router = new \Core\Router();

$router->add('', ['controller'=>'Home', 'action'=>'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

//$router->printRoutingTable();
$router->dispatch($_SERVER['QUERY_STRING']);
