<?php

declare(strict_types=1);

class Routing{

    public static function currentSlug(){
        $slug = $_SERVER["REQUEST_URI"];

        //Suppression des GET dans l'url
        $slugExploded = explode("?", $slug);
        return strtolower($slugExploded[0]);
    }

    public static function getRoute(Users $user) : ?array
    {
        $slug = Routing::currentSlug();

        //Récupération de toutes les routes dans le fichier yml
        $routes = yaml_parse_file('config/routes.yml');
        if( !empty($routes[$slug]) ){

            if(empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"]))
                view::show404("Il y a une erreur dans le routes.yml");

            $c = ucfirst($routes[$slug]["controller"])."Controller";
            $a = $routes[$slug]["action"]."Action";
            $cPath = 'controllers/'.$c.'.class.php';

            if(!empty($routes[$slug]['needAuth'])){
                $user->needAuth();
            }
            if(!empty($routes[$slug]['needGroups'])){
                $user->needGroups($routes[$slug]['needGroups']);
            }

        }else{
            view::show404("L'url n'existe pas.");
        }

        return ["a" => $a, "c" => $c, "cPath" => $cPath];
    }

    public static function getSlug($c=null, $a=null) : ?string
    {

        //Récupération de toutes les routes dans le fichier yml
        $routes = yaml_parse_file('config/routes.yml');
        foreach($routes as $slug => $route){

            if( !empty($route["controller"]) && !empty($route["action"]) && ucfirst($route["controller"]) == ucfirst($c) && $route["action"] == $a)
                return $slug;

        }

        return null;
    }
}