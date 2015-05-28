<?php

class NewsController
{
    public function show($id)
    {

    }

    public function getLast($num)
    {
        $lastItems = News::getNews(true, false, 'DESC', 3);
    }
}