<?php
class UsersController{

    public function defaultAction(){
        echo "User default";
    }

    public function registerAction(){
        $user = new Users();
        $configForm = $user->getFormRegister();

        if(!empty($_POST)){

            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_".$method];

            if($_SERVER["REQUEST_METHOD"]==$method && !empty($data)){
                $validator = new Validator($configForm, $data);
                $configForm["errors"] = $validator->errors;

                if(empty($configForm["errors"])){
                    $user->__set('username', $data["username"]);
                    $user->__set('email', $data["email"]);
                    $user->__set('password', $data["pwd"]);
                    $user->save();
                }
            }
        }

        $v = new View("user_register", "front");
        $v->assign("configFormRegister", $configForm);

    }

    public function loginAction(){
        $v = new View("user_login", "front");
    }

    public function forgetPasswordAction(){
        $v = new View("user_forgetPassword", "front");
    }
}