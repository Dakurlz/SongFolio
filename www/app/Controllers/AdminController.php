<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Routing;
use Songfolio\Models\Contents;
use Songfolio\Models\Users;
use Songfolio\Models\Roles;
use Songfolio\Models\Comments;
use Songfolio\Models\Likes;
use Songfolio\Models\Albums;
use Songfolio\Models\Events;
use Songfolio\Models\Categories;

class AdminController
{

    private $content;
    private $comment;
    private $user;
    private $like;
    private $event;
    private $category;

    public function __construct(Categories $category, Events $event, Albums $album, Likes $like, Contents $content, Users $user, Comments $comment)
    {
        $this->content = $content;
        $this->comment = $comment;
        $this->user = $user;
        $this->like = $like;
        $this->album = $album;
        $this->event = $event;
        $this->category = $category;
    }

    public function defaultAction()
    {
        Users::need('access_admin');

        $articles = $this->content->getAllBy(['type' => 'article']);
        $albums = $this->album->getAllData();
        $events = $this->event->getAllData();
        $likes = $this->like->getAllData();

        $prepareAlbum = $this->prepareAlbumsStat($likes, $albums);
        $prepareEvent = $this->prepareEventsStat($likes, $events);
        $prepareArticle = $this->prepareArticlesStat($articles);
        $prepareCategory = $this->prepareCategoriesStat($articles, $events, $albums);

        $view = new View("admin/dashboard", "back");

        $view->assign('nb_articles', count($articles));
        $view->assign('nb_users', $this->user->count()['nb_users']);
        $view->assign('nb_comments', $this->comment->count()['nb_comments']);
        $view->assign('nb_likes', count($likes));

        $view->assign('articles_titles', $prepareArticle['prepareArticles']);
        $view->assign('articles_comments',  $prepareArticle['prepareCommentsArticles']);

        $view->assign('category_event', $prepareCategory['categEvent']);
        $view->assign('category_nb_event', $prepareCategory['prepareNbEvents']);
        $view->assign('category_article', $prepareCategory['categArticle']);
        $view->assign('category_nb_article', $prepareCategory['prepareNbArticles']);
        $view->assign('category_album', $prepareCategory['categAlbum']);
        $view->assign('category_nb_album', $prepareCategory['prepareNbAlbums']);

        $view->assign('albums_titles', $prepareAlbum['preapreAlbums']);
        $view->assign('albums_likes',  $prepareAlbum['prepareLikeAlbums']);
        $view->assign('albums_comments',  $prepareAlbum['prepareCommentsAlbums']);

        $view->assign('events_titles', $prepareEvent['preapreEvents']);
        $view->assign('events_likes',  $prepareEvent['prepareLikeEvents']);
        $view->assign('events_comments',  $prepareEvent['prepareCommentsEvents']);
    }

    private function prepareCategoriesStat(array $articles, array $events, array $albums)
    {
        $categories = $this->category->getAllData();

        $categArticle = [];
        $categEvent = [];
        $categAlbum = [];

        foreach ($categories as $value) {
            switch ($value['type']) {
                case 'article':
                    $categArticle[] = $value;
                    break;
                case 'event':
                    $categEvent[] = $value;
                    break;
                case 'album':
                    $categAlbum[] = $value;
                    break;
                default:
            }
        }

        $prepareNbArticles = [];
        $prepareNbEvents = [];
        $prepareNbAlbums = [];


        foreach ($categAlbum as $value) {
            $i = 0;
            foreach ($albums as $album) {
                if ($album['category_id'] == $value['id']) {
                    ++$i;
                }
            }
            $prepareNbAlbums[] = $i;
        }

        foreach ($categArticle as $value) {
            $i = 0;
            foreach ($articles as $article) {
                if ($article['category_id'] == $value['id']) {
                    ++$i;
                }
            }
            $prepareNbArticles[] = $i;
        }

        foreach ($categEvent as $value) {
            $i = 0;
            foreach ($events as $event) {
                if ($event['type'] == $value['id']) {
                    ++$i;
                }
            }
            $prepareNbEvents[] = $i;
        }

        return ['categEvent' => $categEvent, 'prepareNbEvents' => $prepareNbEvents, 'categArticle' => $categArticle, 'prepareNbArticles' => $prepareNbArticles, 'categAlbum' => $categAlbum, 'prepareNbAlbums' => $prepareNbAlbums];
    }

    private function prepareArticlesStat(array $articles)
    {
        $prepareArticles = [];
        $prepareCommentsArticles = [];

        foreach ($articles as $value) {
            $prepareCommentsArticles[] = count($this->comment->prepareComments('article', $value['id']));
        }

        return ['prepareArticles' => $prepareArticles, 'prepareCommentsArticles' => $prepareCommentsArticles];
    }

    private function prepareEventsStat(array $likes, array $events)
    {

        $preapreEvents = [];
        $prepareLikeEvents = [];
        $prepareCommentsEvents = [];


        foreach ($events as  $value) {
            $preapreEvents[] = $value['displayName'];
            $prepareLikeEvents[] = Likes::displayLike($likes, $value['id']);
            $prepareCommentsEvents[] = count($this->comment->prepareComments('events', $value['id']));
        }

        return ['preapreEvents' => $preapreEvents, 'prepareLikeEvents' => $prepareLikeEvents, 'prepareCommentsEvents' => $prepareCommentsEvents];
    }

    private function prepareAlbumsStat(array $likes, array $albums)
    {

        $preapreAlbums = [];
        $prepareLikeAlbums = [];
        $prepareCommentsAlbums = [];

        foreach ($albums as  $value) {
            $preapreAlbums[] = $value['title'];
            $prepareLikeAlbums[] = Likes::displayLike($likes, $value['id']);
            $prepareCommentsAlbums[] = count($this->comment->prepareComments('albums', $value['id']));
        }

        return ['preapreAlbums' => $preapreAlbums, 'prepareLikeAlbums' => $prepareLikeAlbums, 'prepareCommentsAlbums' => $prepareCommentsAlbums];
    }


    /* Roles */
    public function rolesAction()
    {
        Users::need('role_view');

        $v = new View("admin/roles_list", "back");
        $v->assign('roles', (new Roles(null))->getAllData());
    }
    public function rolesAddAction()
    {
        Users::need('role_add');

        $role = new Roles();

        if (!empty($_POST['perms']) && !empty($_POST['name'])) {
            $role->__set('name', $_POST['name']);
            $role->__set('perms', $_POST['perms']);
            $role->save();

            $_SESSION['alert']['success'][] = 'Le role a bien été ajouté.';

            header('Location: ' . Routing::getSlug('admin', 'rolesEdit') . '?role=' . $role->id());
            exit;
        } else if (!empty($_POST['perms']) || !empty($_POST['name'])) {
            $_SESSION['alert']['danger'][] = 'Vous devez renseigner un titre et un droit au minimum.';
        }

        $v = new View("admin/roles_edit", "back");
        $v->assign('role', $role);
        $v->assign('permsList', $role->permsList());
    }
    public function rolesEditAction()
    {
        Users::need('role_edit');

        if (!isset($_GET['role'])) {
            View::show404();
        }

        $role = new Roles($_GET['role']);

        if (!empty($_POST['perms']) && !empty($_POST['name'])) {
            $role->__set('name', $_POST['name']);
            $role->__set('perms', $_POST['perms']);
            $role->save();
            $_SESSION['alert']['success'][] = 'Le role a bien été modifié.';
        } else if (!empty($_POST['perms']) || !empty($_POST['name'])) {
            $_SESSION['alert']['danger'][] = 'Vous devez renseigner un titre et un droit au minimum.';
        }

        $v = new View("admin/roles_edit", "back");
        $v->assign('role', $role);
        $v->assign('permsList', $role->permsList());
    }
    public function rolesDelAction()
    {
        Users::need('role_del');

        if (!isset($_GET['role'])) {
            View::show404();
        }

        $user = new Users(["role_id" => $_GET['role']]);
        if (!$user->__get('id')) {
            $menu = new Roles($_GET['role']);
            $menu->remove();
            $_SESSION['alert']['info'][] = 'Le role a bien été supprimé.';
        } else {
            $_SESSION['alert']['danger'][] = 'Vous ne pouvez pas supprimer un groupe utilisé par un utilisateur.';
        }

        header('Location: ' . Routing::getSlug('admin', 'roles'));
    }
}
