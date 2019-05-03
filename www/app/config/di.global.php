<?php
use app\Controllers\AdminController;
use app\Controllers\ContentsController;
use app\Controllers\CategoriesController;
use app\Controllers\NameController;
use app\Controllers\PagesController;
use app\Controllers\UsersController;

use app\Models\Users;


return [
    Users::class => function($container) {
        return new Users();
    },
    UsersController::class => function ($container) {
        $usersModel = $container[Users::class]($container);
        return new UsersController($usersModel);
    },
    PagesController::class => function ($container) {
        return new PagesController();
    },
    ContentsController::class => function ($container) {
        return new ContentsController();
    },
    CategoriesController::class => function ($container) {
        return new CategoriesController();
    },
    NameController::class => function ($container) {
        return new NameController();
    },
    AdminController::class => function ($container) {
        return new AdminController();
    },
];