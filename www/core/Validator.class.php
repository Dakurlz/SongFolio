<?php

declare(strict_types=1);

class Validator{

    public $errors = [];

    public function __construct( $config, $data ){

        //vérification du nombre de champs
        if( count($data) != count($config["data"]) ){
            die("Tentative de Faille XSS");
        }

        foreach($config["data"] as $name => $input){
            //required
            if( $input["required"] && empty($data[$name]) ){
                die("Tentative de Faille XSS");
            }else{

                //Minlength
                if( isset($input["minlength"]) && !self::checkMinLength($data[$name], $input["minlength"])){
                    $this->errors[]=$input["error"];
                    continue;
                }
                //Maxlength
                if( isset($input["maxlength"]) && !self::checkMaxLength($data[$name], $input["maxlength"])){
                    $this->errors[]=$input["error"];
                    continue;
                }
                //Email
                if($input["type"]=="email" && !self::checkEmail($data[$name])){
                    $this->errors[]=$input["error"];
                    continue;
                }
                //Mot de passe
                if($input["type"]=="password" && !self::checkPwd($data[$name])){
                    $this->errors[]=$input["error"];
                    continue;
                }
                //Confirm
                if(isset($input["confirm"]) && $data[$name] != $data[$input["confirm"]]){
                    $this->errors[]=$input["error"];
                    continue;
                }
            }
        }
    }

    public static function checkMinLength($string, $length){
        return strlen(trim($string))>=$length;
    }
    public static function checkMaxLength($string, $length){
        return strlen(trim($string))<=$length;
    }
    public static function checkEmail($string){
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }
    public static function checkPwd($string){
        return (    preg_match("#[A-Z]#", $string) &&
                    preg_match("#[a-z]#", $string) &&
                    preg_match("#[0-9]#", $string) );
    }
}