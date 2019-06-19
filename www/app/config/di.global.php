<?php
use Songfolio\Controllers\AdminController;
use Songfolio\Controllers\ContentsController;
use Songfolio\Controllers\CategoriesController;
use Songfolio\Controllers\NameController;
use Songfolio\Controllers\PagesController;
use Songfolio\Controllers\UsersController;
use Songfolio\Controllers\CommentsController;
use Songfolio\Controllers\SettingsController;
use Songfolio\Controllers\EventsController;

use Songfolio\Models\Users;
use Songfolio\Models\Contents;
use Songfolio\Models\Categories;
use Songfolio\Models\Comments;
use Songfolio\Models\Events;
use Songfolio\Models\Roles;
use Songfolio\Models\Albums;
use Songfolio\Controllers\AlbumsController;

return [
    Users::class => function ($container) {
        return new Users();
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
    Albums::class => function ($container){
        return new Albums();
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
    AlbumsController::class => function ($container) {
        $albumModel = $container[Albums::class]($container);
        return new AlbumsController($albumModel);
    },
    AdminController::class => function ($container) {
        return new AdminController();
    },
];
