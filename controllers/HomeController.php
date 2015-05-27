<?php

class HomeController
{
    public function index()
    {
        $title = 'welkom';
        $content = 'test'; // via de klasse Pages de inhoud ophalen
        $view = 'views/home.php';

        include_once 'views/master.php';
    }
}