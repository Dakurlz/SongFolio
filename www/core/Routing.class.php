<?php
class Routing{

	public static $routeFile = "routes.yml";

	public static function getRoute($slug){

		//Récupération de toutes les routes se trouvant dans notre yml
		$routes = yaml_parse_file(self::$routeFile);
		//Est ce que la route existe
		if( !empty($routes[$slug]) ){

			//On vérifie qu'il n'y a pas une mauvaise écrite des routes dans le fichier
			if(empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"])){
				die("Il y a une erreur dans le routes.yml");
			}

			//Ajout des suffixes
			$c = ucfirst( $routes[$slug]["controller"] )."Controller";
			$a = $routes[$slug]["action"]."Action";
			//Précision du chemin pour acceder au controller
			$cPath = "controllers/".$c.".class.php";

		}else{
			//Aucune route ne correspondx
			return null;
		}

		return ["c"=>$c,"a"=>$a,"cPath"=>$cPath];
	}



	public static function getSlug($c=null, $a=null){

		$routes = yaml_parse_file(self::$routeFile);

		foreach ($routes as $slug => $cAnda) {
			if( !empty($cAnda["controller"]) && 
				!empty($cAnda["action"]) &&  
				$cAnda["controller"] == $c && 
				$cAnda["action"] == $a)
			{
				return $slug;
			}
		}
		return null;		
	}




}










