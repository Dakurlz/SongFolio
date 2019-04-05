<?php
require "config/conf.inc.php";
include "core/Autoloader.class.php";
ini_set('display_errors', 1);

Autoloader::register();

session_start();

$user = new Users();

extract(Routing::getRoute($user));

if (file_exists($cPath))
{
    include $cPath;

    if(class_exists($c)){

        $cObject = new $c($user);

        if(method_exists($cObject, $a)){
            $cObject->$a();
        }else{
            view::show404("L'action ".$a." n'existe pas.");
        }
    }else{
        view::show404("La class ".$c." n'existe pas.");
    }
}else{
    view::show404("Le fichier controller ".$c." n'existe pas.");
}