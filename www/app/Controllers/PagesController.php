<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Models\Events;
use Songfolio\Models\Contents;
use Songfolio\Models\Categories;
use Songfolio\Core\Helper;

class PagesController{
    private $event;
    private $category;
    private $article;

    public function __construct(Events $event, Categories $category, Contents $article)
    {
        $this->event = $event;
        $this->category = $category;
        $this->article = $article;
    }

    public function defaultAction() : void
    {
        $events = $this->event->getAllDataWithLimit(3);
        $categories = $this->category->getAllBy(['type' => 'event']);
        $articles = $this->article->getAllBy(['type' => 'article', 'published'=> 1 ], ['orderBy' => 'date_create', 'orderTo' => 'DESC']);
        foreach ($events as $key => $event) {
            $events[$key]['type'] = Helper::searchInArray($categories, $event['type'], 'name');
        }
        $view = new View("home", "front");
        $view->assign('events', $events);
        $view->assign('articles', $articles);
    }

    public function renderEventsPageAction()
    {
        $events = $this->event->getAllData();
        $categories = $this->category->getAllBy(['type' => 'event']);
        foreach ($events as $key => $event) {
            $events[$key]['type'] = Helper::searchInArray($categories, $event['type'], 'name');
        }
        $view = new View("events", "front");
        $view->assign('events', $events);
    }

}