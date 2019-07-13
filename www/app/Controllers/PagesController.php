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
use Songfolio\Models\Users;

class PagesController
{
    private $event;
    private $category;
    private $article;
    private $song;
    private $like;
    private $album;
    private $user;

    public function __construct(Users $user, Events $event, Categories $category, Contents $article, Songs $song, Albums $album, Likes $like)
    {
        $this->event = $event;
        $this->category = $category;
        $this->article = $article;
        $this->song = $song;
        $this->album = $album;
        $this->like = $like;
        $this->user = $user;
    }


    public function defaultAction()
    {
        $articles = $this->article->getAllBy(['type' => 'article', 'published' => 1], ['orderBy' => 'date_create', 'orderTo' => 'DESC']);
        $likes = $this->like->getAllData();

        $likesSongs = [];
        $likesAlbums = [];
        foreach ($likes as $like) {
            if ($like['type'] == 'songs') $likesSongs[] = $like;
            if ($like['type'] == 'albums') $likesAlbums[] = $like;
        }

        $events = self::renderEvent();
        $albums = self::renderAlbum($likesAlbums);
        $songs = self::prepareSong($likesSongs);


        $view = new View("home", "front");
        $view->assign('events', $events);
        $view->assign('articles', $articles);
        $view->assign('songs', $songs);
        $view->assign('albums', $albums);
    }

    private function renderEvent(): array
    {
        $categories = $this->category->getAllBy(['type' => 'event']);

        $events = $this->event->getAllData();
        foreach ($events as $key => $event) {
            $events[$key]['type'] = Helper::searchInArray($categories, $event['type'], 'name');
        }
        return $events;
    }

    private function renderAlbum($likesAlbums): array
    {
        $categories = $this->category->getAllBy(['type' => 'album']);

        $albums = $this->album->getAllDataWithLimit(5);
        foreach ($albums as $key => $album) {
            $albums[$key]['category_name'] = Helper::searchInArray($categories,  $album['category_id'], 'name');
            $albums[$key]['nbLikesAlbums'] = Likes::displayLike($likesAlbums, $album['id']);
            $albums[$key]['checkUserLike'] = Likes::checkIfUserLiked($likesAlbums, $album['id'], $this->user->__get('id'));

        }

        $prepare = array_column($albums, 'nbLikesAlbums');
        array_multisort($prepare, SORT_DESC, $albums);

        return $albums;
    }

    private function prepareSong($likesSongs): array
    {
        $albums = $this->album->getAllData();
        $songs = $this->song->getAllData();

        foreach ($songs as $key => $song) {
            if ($song['album_id'] != null) {
                $songs[$key]['album_name'] = Helper::searchInArray($albums, $song['album_id'], 'title');
            }
            $songs[$key]['nbLikesSongs'] = Likes::displayLike($likesSongs, $song['id']);
            $songs[$key]['checkUserLike'] = Likes::checkIfUserLiked($likesSongs, $song['id'], $this->user->__get('id'));
        }

        $prepare = array_column($songs, 'nbLikesSongs');
        array_multisort($prepare, SORT_DESC, $songs);

        return $songs;
    }


    public function renderAlbumsAction()    
    {
        $likesAlbums = $this->like->getAllBy(['type' => 'albums']);
        $albums = $this->renderAlbum($likesAlbums);
        $view = new View("albums/albums", "front");
        $view->assign('albums', $albums);
    }


    public function renderSongsAction()
    {
        $likesSongs = $this->like->getAllBy(['type' => 'songs']);
        $songs =  $this->prepareSong($likesSongs);
        $view = new View("songs/songs", "front");
        $view->assign('songs', $songs);
    }

    public function renderEventsPageAction()
    {

        $likes = $this->like->getAllBy(['type' => 'events']);

        $events = $this->event->getAllData();
        $categories = $this->category->getAllBy(['type' => 'event']);
        foreach ($events as $key => $event) {
            $events[$key]['type'] = Helper::searchInArray($categories, $event['type'], 'name');
            $events[$key]['nbLikesEvents'] = Likes::displayLike($likes, $event['id']);
            $events[$key]['checkUserLike'] = Likes::checkIfUserLiked($likes, $event['id'], $this->user->__get('id'));
        }
        $view = new View("events", "front");
        $view->assign('events', $events);
    }
}
