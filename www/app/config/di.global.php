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

use Songfolio\Models\Users;
use Songfolio\Models\Contents;
use Songfolio\Models\Categories;
use Songfolio\Models\Comments;
use Songfolio\Models\Events;
use Songfolio\Models\Roles;
use Songfolio\Models\Albums;
use Songfolio\Controllers\AlbumsController;
use Songfolio\Models\Songs;
use Songfolio\Controllers\SongsController;
use Songfolio\Models\Menus;
use Songfolio\Core\Install;

return [
    Users::class => function ($container) {
        return new Users();
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
    Menus::class => function ($container){
        return new Menus();
    },
    Install::class => function ($container){
        return new Install();
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
        return new PagesController($eventsModel, $categoryModel, $contentsModel);
    },
    SettingsController::class => function ($container) {
        return new SettingsController();
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
        return new AdminController();
    },
    MenusController::class => function ($container) {
        $menuModel = $container[Menus::class]($container);
        return new MenusController($menuModel);
    },
];
