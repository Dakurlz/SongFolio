<?php

declare (strict_types = 1);

namespace Songfolio\Core;
use Songfolio\Models\Users;
use Songfolio\Core\Helper;

class Routing
{

    public static function currentSlug($withoutSlash = false): string
    {
        $slug = $_SERVER["REQUEST_URI"];

        //Suppression des GET dans l'url
        $slugExploded = explode("?", $slug);
        return ($withoutSlash ? trim(strtolower($slugExploded[0]), '/') : strtolower($slugExploded[0]));
    }

    public static function isSlugExist($slug)
    {
        $routes = yaml_parse_file('app/config/routes.yml');
        if (!empty($routes[$slug])) {
            return true;
        }
        return false;
    }

    public static function getRoutes()
    {
        return yaml_parse_file('app/config/routes.yml');
    }

    /**
     * @param Users $user
     * @return array
     */
    public static function getRoute()
    {
        $slug = Routing::currentSlug();
        $routes = yaml_parse_file('app/config/routes.yml');

        //Si cms non installé, on ne laisse pas l'accès hors de l'installation
        if(!Helper::isCmsInstalled() && $routes[$slug]["controller"] !== 'Install'){
            header('Location: '.Routing::getSlug('install', 'index'));
        }

        //Si le cms est installé, on autorise pas l'accès à l'installation
        if(Helper::isCmsInstalled() && $routes[$slug]["controller"] == 'Install'){
            header('Location: /');
        }



        if (!empty($routes[$slug])) {

            if (empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"])) {
                View::show404("Il y a une erreur dans le routes.yml");
            }

            $controller = ucfirst($routes[$slug]["controller"]);
            $controller = $controller . "Controller";

            $action = $routes[$slug]["action"] . "Action";
            $controllerPath = 'app/controllers/' . $controller . '.php';

            if(Helper::isCmsInstalled()){
                $user = new Users();

                if (!empty($routes[$slug]['needAuth'])) {
                    $user->needAuth();
                }
                if (!empty($routes[$slug]['needGroups'])) {
                    $user->needGroups($routes[$slug]['needGroups']);
                }
            }

            return ['controller' => $controller, 'action' => $action, 'controllerPath' => $controllerPath];
        }
        return [];
    }

    /**
     * return slug function
     *
     * @param [string] $controller
     * @param [string] $action
     * @return string|null
     */
    public static function getSlug($controller, $action): ?string
    {
        //Récupération de toutes les routes dans le fichier yml
        $routes = yaml_parse_file('app/config/routes.yml');
        foreach ($routes as $slug => $route) {
            if (!empty($route["controller"]) && !empty($route["action"]) && ucfirst($route["controller"]) == ucfirst($controller) && $route["action"] == $action)
                return $slug;
        }

        return null;
    }
}
