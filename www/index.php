<?php
require "app/config/conf.inc.php";
require "app/core/Autoloader.class.php";
require "app/lib/dev.conf.php";

use app\Core\View;
use app\Core\Autoloader;
use app\Core\Routing;
use app\Models\Contents;
use app\Models\Users;

Autoloader::register();


session_start();

$user = new Users();

if($route = Routing::getRoute($user)){
    extract($route);

    $container = [];
    $container += require 'app/config/di.global.php';


    if (file_exists($controllerPath)) {
        include $controllerPath;

        if(class_exists('\\app\\Controllers\\' . $controller)){

            $controllerObject = $container['app\\Controllers\\'.$controller]($container);

            if(method_exists($controllerObject, $action)){
                $controllerObject->$action();
            }else{
                View::show404("L'action ".$action." n'existe pas.");
            }
        }else{
            View::show404("La class ".$controller." n'existe pas.");
        }
    }else{
        View::show404("Le fichier controller ".$controller." n'existe pas.");
    }
}elseif( $content = Contents::getBySlug( Routing::currentSlug(true) ) ){

    $content->show();

}else{
    View::show404("L'url n'existe pas.");
}