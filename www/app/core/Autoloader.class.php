<?php

namespace app\Core;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
       $classname = substr(strrchr($class, "\\"), 1);
        $classPath = "app/core/".$classname.".class.php";
        $pathModels = "app/models/".$classname.".class.php";
        $pathControllers = "app/controllers".$classname.".class.php";
        if(file_exists($classPath)){
            include $classPath;
        }else  if(file_exists($pathModels)) {
            include $pathModels;
        } else if(file_exists($pathControllers)){
            include $pathControllers;
        }
    }
}