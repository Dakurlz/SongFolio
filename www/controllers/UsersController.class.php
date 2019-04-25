<?php

declare(strict_types=1);

class UsersController{

    private $user;

    public function __construct(Users $user){
        $this->user = $user;
    }


    public function defaultAction() : void
    {
        echo "User default";
    }

    public function dashboardAction() : void
    {
        $v = new View("user_dashboard", "front");
        $v->assign('user', $this->user);
    }

    public function registerAction() : void
    {
        if($this->user->is('connected'))
        {
            header('Location: '. Routing::getSlug('users', 'dashboard'));
        }

        $configForm = $this->user->getFormRegister();

        if(!empty($_POST)){

            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_".$method];

            if($_SERVER["REQUEST_METHOD"]==$method && !empty($data)){
                $validator = new Validator($configForm, $data);
                $configForm["errors"] = $validator->errors;

                if(empty($configForm["errors"])){
                    $this->user->__set('username', $data["username"]);
                    $this->user->__set('email', $data["email"]);
                    $this->user->__set('password', $data["pwd"]);
                    $this->user->save();
                }
            }
        }

        $v = new View("user_register", "front");
        $v->assign("configFormRegister", $configForm);

    }

    public function loginAction() : void
    {
        if($this->user->is('connected'))
        {
            header('Location: '. Routing::getSlug('users', 'dashboard'));
        }

        $user = new Users();
        $configForm = $user->getFormLogin();

        if(!empty($_POST)){

            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_".$method];

            if($_SERVER["REQUEST_METHOD"]==$method && !empty($data)){
                $validator = new Validator($configForm, $data);
                $configForm["errors"] = $validator->errors;

                if(empty($configForm["errors"])){
                    if($user->getOneBy(['username'=>$data['username']], true) && password_verify($data['password'], $user->__get('password'))){
                        //$token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");
                        $_SESSION['user'] = $user->__get('id');

                        if( isset($_GET['redirect']) )
                        {
                            $redirect = htmlspecialchars( urldecode($_GET['redirect']) );
                            header('Location: '.$redirect);
                            exit;
                        }

                        header('Location: '.Routing::getSlug("users","dashboard"));
                    }else{
                        $configForm["errors"][] = "Incorrect";
                    }
                }
            }
        }

        $v = new View("user_login", "front");
        $v->assign("configFormLogin", $configForm);
    }

    public function logoutAction() : void
    {
        unset($_SESSION['user']);

        header('Location: '.BASE_URL);
    }

    public function forgetPasswordAction() : void
    {
        $v = new View("user_forgetPassword", "front");
    }
}