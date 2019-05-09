<?php
use Songfolio\Controllers\AdminController;
use Songfolio\Controllers\ContentsController;
use Songfolio\Controllers\CategoriesController;
use Songfolio\Controllers\NameController;
use Songfolio\Controllers\PagesController;
use Songfolio\Controllers\UsersController;
use Songfolio\Controllers\CommentsController;

use Songfolio\Models\Users;
use Songfolio\Models\Contents;
use Songfolio\Models\Categories;
use Songfolio\Models\Comments;

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
