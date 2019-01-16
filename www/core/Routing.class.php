<?php
class Routing{

    public static function getRoute($slug){

        //Récupération de toutes les routes dans le fichier yml
        $routes = yaml_parse_file('config/routes.yml');
        if( !empty($routes[$slug]) ){

            if(empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"]))
                die("Il y a une erreur dans le routes.yml");

            $c = ucfirst($routes[$slug]["controller"])."Controller";
            $a = $routes[$slug]["action"]."Action";
            $cPath = 'controllers/'.$c.'.class.php';

        }else{
            return null;
        }

        return ["a" => $a, "c" => $c, "cPath" => $cPath];
    }

    public static function getSlug($c=null, $a=null){

        //Récupération de toutes les routes dans le fichier yml
        $routes = yaml_parse_file('config/routes.yml');
        foreach($routes as $slug => $route){

            if( !empty($route["controller"]) && !empty($route["action"]) && ucfirst($route["controller"]) == ucfirst($c) && $route["action"] == $a)
                return $slug;

        }

        return null;
    }
}