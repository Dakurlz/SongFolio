<?php
use app\Controllers\AdminController;
use app\Controllers\ContentsController;
use app\Controllers\CategoriesController;
use app\Controllers\NameController;
use app\Controllers\PagesController;
use app\Controllers\UsersController;
use app\Controllers\CommentsController;

use app\Models\Users;
use app\Models\Contents;
use app\Models\Categories;
use app\Models\Comments;

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
    UsersController::class => function ($container) {
        $usersModel = $container[Users::class]($container);
        return new UsersController($usersModel);
    },
    PagesController::class => function ($container) {
        return new PagesController();
    },
    ContentsController::class => function ($container) {
        $contentsModel = $container[Contents::class]($container);
        return new ContentsController($contentsModel);
    },
    CategoriesController::class => function ($container) {
        $categorieModel = $container[Categories::class]($container);
        return new CategoriesController($categorieModel);
    },
    CommentsController::class => function ($container) {
        $commentsModel = $container[Comments::class]($container);
        return new CommentsController($commentsModel);
    },
    NameController::class => function ($container) {
        return new NameController();
    },
    AdminController::class => function ($container) {
        return new AdminController();
    },
];
