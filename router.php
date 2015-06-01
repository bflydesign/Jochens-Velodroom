<?php

$router = new Router();
$router->AddPage('home', 'HomeController', 'index');
$router->AddPage('nieuws', 'NewsController', 'index');
$router->AddPage('contact', 'ContactController', 'index');

// -- ADMIN
$router->AddPage('login', 'AuthController', 'show');