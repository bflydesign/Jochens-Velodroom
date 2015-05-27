<?php
// -- sessie starten
session_start();

// -- vendor autoload
include_once'vendor/autoload.php';

// -- route file
include_once 'router.php';

// -- router
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$controllerData = $router->GetPage($page);
if ($controllerData == false) {
    print '404';
    exit;
}

$controller = $controllerData['controller'];
$method = $controllerData['method'];

$controllerObject = new $controller;
if( ! method_exists($controllerObject, $method)) {
    print 'method does not exist';
    exit;
}
$controllerObject->$method();  // {$method}() kan ook - soort escape