<?php
require "app/Config/conf.inc.php";
require "app/Core/Autoloader.php";
require "app/Lib/dev.conf.php";

use Songfolio\Core\View;
use Songfolio\Core\Autoloader;
use Songfolio\Core\Routing;
use Songfolio\Models\Contents;
use Songfolio\Models\Users;
use Songfolio\Models\Events;

$autoloader = new Autoloader();
$autoloader->addNamespace('Songfolio', 'app');
$autoloader->register();


session_start();

$user = new Users();
$route = Routing::getRoute($user);

if (!empty($route)) {
    extract($route);

    $container = [];
    $container += require 'app/Config/di.global.php';


    if (file_exists($controllerPath)) {
        include $controllerPath;

        if (class_exists('\\Songfolio\\Controllers\\' . $controller)) {

            $controllerObject = $container['Songfolio\\Controllers\\' . $controller]($container);

            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                View::show404("L'action " . $action . " n'existe pas.");
            }
        } else {
            View::show404("La class " . $controller . " n'existe pas.");
        }
    } else {
        View::show404("Le fichier controller " . $controller . " n'existe pas.");
    }
} else {
    if (View::renderPages());
    else View::show404("L'url n'existe pas.");
}
