<?php
require "config/conf.inc.php";
ini_set('display_errors', 1);

function myAutoLoader($class){
    $cPath = "core/".$class.".class.php";
    $pathModels = "models/".$class.".class.php";
    if(file_exists($cPath)){
        include $cPath;
    }else  if(file_exists($pathModels)) {
        include $pathModels;
    }
}
//Appel une fonction définie si on essaye une instance d'une class qui n'existe pas.
spl_autoload_register("myAutoloader");

$slug = $_SERVER["REQUEST_URI"];

//Suppression des GET dans l'url
$slugExploded = explode("?", $slug);
$slug = strtolower($slugExploded[0]);


$route = Routing::getRoute($slug);
if(is_null($route)){
    die("L'url n'existe pas.");
}
extract($route);

if (file_exists($cPath))
{
    include $cPath;

    if(class_exists($c)){

        $cObject = new $c();

        if(method_exists($cObject, $a)){
            $cObject->$a();
        }else{
            die("L'action ".$a." n'existe pas.");
        }
    }else{
        die("La class ".$c." n'existe pas.");
    }
}else{
    die("Le fichier controller ".$c." n'existe pas.");
}