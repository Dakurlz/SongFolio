<?php

use Songfolio\Controllers\AdminController;
use Songfolio\Controllers\ContentsController;
use Songfolio\Controllers\CategoriesController;
use Songfolio\Controllers\PagesController;
use Songfolio\Controllers\UsersController;
use Songfolio\Controllers\CommentsController;
use Songfolio\Controllers\SettingsController;
use Songfolio\Controllers\EventsController;
use Songfolio\Controllers\AlbumsController;
use Songfolio\Controllers\MenusController;
use Songfolio\Controllers\InstallController;
use Songfolio\Controllers\SongsController;
use Songfolio\Controllers\LikesController;

use Songfolio\Models\Users;
use Songfolio\Models\Contents;
use Songfolio\Models\Categories;
use Songfolio\Models\Comments;
use Songfolio\Models\Events;
use Songfolio\Models\Roles;
use Songfolio\Models\Albums;
use Songfolio\Models\Songs;
use Songfolio\Models\Menus;
use Songfolio\Core\Install;
use Songfolio\Controllers\SitemapController;
use Songfolio\Models\Likes;

return [
    Users::class => function ($container) {
        return new Users();
    },
    Likes::class => function ($container) {
        return new Likes();
    },
    Songs::class => function ($container) {
        return new Songs();
    },
    Categories::class => function ($container) {
        return new Categories();
    },
    Contents::class => function ($container) {
        return new Contents();
    },
    Comments::class => function ($container) {
        return new Comments();
    },
    Roles::class => function ($container) {
        return new Roles();
    },
    Events::class => function ($container) {
        return new Events();
    },
    Albums::class => function ($container) {
        return new Albums();
    },
    Menus::class => function ($container) {
        return new Menus();
    },
    Install::class => function ($container) {
        return new Install();
    },
    SitemapController::class => function ($container) {
        return new SitemapController();
    },
    UsersController::class => function ($container) {
        $usersModel = $container[Users::class]($container);
        $rolesModel = $container[Roles::class]($container);
        return new UsersController($usersModel, $rolesModel);
    },
    PagesController::class => function ($container) {
        $eventsModel = $container[Events::class]($container);
        $categoryModel = $container[Categories::class]($container);
        $contentsModel = $container[Contents::class]($container);
        $likesModel = $container[Likes::class]($container);
        $songModel = $container[Songs::class]($container);
        $albumModel = $container[Albums::class]($container);
        $usersModel = $container[Users::class]($container);

        return new PagesController($usersModel, $eventsModel, $categoryModel, $contentsModel, $songModel, $albumModel, $likesModel);
    },
    SettingsController::class => function ($container) {
        return new SettingsController();
    },
    LikesController::class => function ($container) {
        $likesModel = $container[Likes::class]($container);
        return new LikesController($likesModel);
    },
    InstallController::class => function ($container) {
        $installModel = $container[Install::class]($container);
        return new InstallController($installModel);
    },
    ContentsController::class => function ($container) {
        $contentsModel = $container[Contents::class]($container);
        $categoryModel = $container[Categories::class]($container);
        $usersModel = $container[Users::class]($container);
        return new ContentsController($contentsModel, $categoryModel, $usersModel);
    },
    CategoriesController::class => function ($container) {
        $categoryModel = $container[Categories::class]($container);
        return new CategoriesController($categoryModel);
    },
    CommentsController::class => function ($container) {
        $commentsModel = $container[Comments::class]($container);
        $usersModel = $container[Users::class]($container);
        return new CommentsController($commentsModel, $usersModel);
    },
    EventsController::class => function ($container) {
        $eventsModel = $container[Events::class]($container);
        $categoryModel = $container[Categories::class]($container);
        return new EventsController($eventsModel, $categoryModel);
    },
    SongsController::class => function ($container) {
        $songModel = $container[Songs::class]($container);
        $albumModel = $container[Albums::class]($container);

        return new SongsController($songModel, $albumModel);
    },
    AlbumsController::class => function ($container) {
        $albumModel = $container[Albums::class]($container);
        $albumCategory = $container[Categories::class]($container);
        return new AlbumsController($albumModel, $albumCategory);
    },
    AdminController::class => function ($container) {
        $contentsModel = $container[Contents::class]($container);
        $commentsModel = $container[Comments::class]($container);
        $usersModel = $container[Users::class]($container);
        $likesModel = $container[Likes::class]($container);
        $albumModel = $container[Albums::class]($container);
        $eventsModel = $container[Events::class]($container);
        $categoryModel = $container[Categories::class]($container);

        return new AdminController($categoryModel, $eventsModel, $albumModel, $likesModel, $contentsModel, $usersModel, $commentsModel);
    },
    MenusController::class => function ($container) {
        $menuModel = $container[Menus::class]($container);
        return new MenusController($menuModel);
    },
];
