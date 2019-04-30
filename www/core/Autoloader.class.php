<?php
class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $classPath = "core/".$class.".class.php";
        $pathModels = "models/".$class.".class.php";
        if(file_exists($classPath)){
            include $classPath;
        }else  if(file_exists($pathModels)) {
            include $pathModels;
        }
    }
}