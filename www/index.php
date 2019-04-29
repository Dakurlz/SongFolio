<?php
require "config/conf.inc.php";
include "core/Autoloader.class.php";
ini_set('display_errors', 1);

Autoloader::register();

session_start();

$user = new Users();

if($route = Routing::getRoute($user)){
    extract($route);

    if (file_exists($controllerPath))
    {
        include $controllerPath;

        if(class_exists($controller)){

            $controllerObject = new $controller($user);

            if(method_exists($controllerObject, $action)){
                $controllerObject->$action();
            }else{
                view::show404("L'action ".$action." n'existe pas.");
            }
        }else{
            view::show404("La class ".$controller." n'existe pas.");
        }
    }else{
        view::show404("Le fichier controller ".$controller." n'existe pas.");
    }
}elseif( $content = Contents::getBySlug( Routing::currentSlug(true) ) ){

    $content->show();

}else{
    view::show404("L'url n'existe pas.");
}