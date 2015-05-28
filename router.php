<?php

$router = new Router();
$router->AddPage('home', 'HomeController', 'index');
$router->getPage('niews', 'NewsController', 'index');
$router->AddPage('contact', 'ContactController', 'index');

// -- ADMIN
$router->AddPage('login', 'AuthController', 'show');