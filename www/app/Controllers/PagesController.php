<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Models\Events;
use Songfolio\Models\Contents;
use Songfolio\Models\Categories;
use Songfolio\Core\Helper;
use Songfolio\Models\Songs;
use Songfolio\Models\Albums;
use Songfolio\Models\Likes;

class PagesController
{
    private $event;
    private $category;
    private $article;
    private $song;
    private $like;
    private $album;

    public function __construct(Events $event, Categories $category, Contents $article, Songs $song, Albums $album, Likes $like)
    {
        $this->event = $event;
        $this->category = $category;
        $this->article = $article;
        $this->song = $song;
        $this->album = $album;
        $this->like = $like;
    }


    public function defaultAction(): void
    {
        $articles = $this->article->getAllBy(['type' => 'article', 'published' => 1], ['orderBy' => 'date_create', 'orderTo' => 'DESC']);
        $likes = $this->like->getAllData();

        $likesSongs = [];
        foreach ($likes as $like) {
            if ($like['type'] == 'songs') $likesSongs[] = $like;
        }

        $events = self::renderEvent();
        $albums = self::renderAlbum();
        $songs = self::renderSong($albums, $likes);


        $view = new View("home", "front");
        $view->assign('events', $events);
        $view->assign('articles', $articles);
        $view->assign('songs', $songs);
        $view->assign('albums', $albums);
        $view->assign('likesSongs', $likesSongs);
    }

    private function renderEvent(): array
    {
        $categories = $this->category->getAllBy(['type' => 'event']);

        $events = $this->event->getAllDataWithLimit(3);
        foreach ($events as $key => $event) {
            $events[$key]['type'] = Helper::searchInArray($categories, $event['type'], 'name');
        }
        return $events;
    }

    private function renderAlbum(): array
    {
        $categories = $this->category->getAllBy(['type' => 'album']);

        $albums = $this->album->getAllData();
        foreach ($albums as $key => $album) {
            $albums[$key]['category_name'] = Helper::searchInArray($categories,  $album['category_id'], 'name');
        }
        return $albums;
    }

    private function renderSong(array $albums, array $likes_): array
    {

        $songs = $this->song->getAllData();

        foreach ($songs as $key => $song) {
            // $song[$key]['likes'] = 0;

            // foreach ($likes as $like) {
            //     if ($like['type_id'] === $song['id']) {
            //         $songs[$key]['likes'] += ++$song[$key]['likes'];
            //     }
            // }

            if ($song['album_id'] != null) {
                $songs[$key]['album_name'] = Helper::searchInArray(array_filter($albums, function ($key) {
                    return $key == 'album';
                }, ARRAY_FILTER_USE_KEY), $song['album_id'], 'title');
            }
        }

        return $songs;
    }





    public function renderEventsPageAction(): void
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
