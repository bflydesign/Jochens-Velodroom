<?php

class NewsController
{
    public function index()
    {
        $title = 'nieuws';
        $view = 'views/news.php';

        $news = News::getNews(true);

        include_once 'views/master.php';
    }

    public function item($id)
    {

    }
}