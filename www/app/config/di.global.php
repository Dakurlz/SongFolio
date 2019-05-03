<?php
use app\Controllers\AdminController;
use app\Controllers\ContentsController;
use app\Controllers\CategoriesController;
use app\Controllers\NameController;
use app\Controllers\PagesController;
use app\Controllers\UsersController;

use app\Models\Users;
use app\Models\Contents;

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
    UsersController::class => function ($container) {
        $usersModel = $container[Users::class]($container);
        return new UsersController($usersModel);
    },
    PagesController::class => function ($container) {
        return new PagesController();
    },
    ContentsController::class => function ($container) {
        $conentsModel = $container[Contents::class]($container);
        return new ContentsController($conentsModel);
    },
    CategoriesController::class => function ($container) {
        $categorieModel = $container[Categories::class]($container);
        return new CategoriesController($categorieModel);
    },
    NameController::class => function ($container) {
        return new NameController();
    },
    AdminController::class => function ($container) {
        return new AdminController();
    },
];
