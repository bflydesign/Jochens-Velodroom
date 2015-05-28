<?php

class HomeController
{
    public function index()
    {
        $title = 'welkom';
        $content = 'test'; // via de klasse Pages de inhoud ophalen
        $view = 'views/home.php';
        
        $lastNews = News::getNews(true, false, 'DESC', 3);

        include_once 'views/master.php';
    }
}