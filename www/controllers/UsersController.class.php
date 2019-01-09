<?php
class UsersController{

    public function defaultAction(){
        echo "User default";
    }

    public function registerAction(){
        $user = new Users(13);
		echo $user->__get('lastname');
		$user->__set('lastname', 'longJUMEaux');
		$user->save();
		print_r($user);
		die;
		
        $v = new View("user_register", "front");
        $v->assign("configFormRegister", $user->getFormRegister());
    }
    public function saveAction(){
    }

    public function loginAction(){
        $v = new View("user_login", "front");
    }

    public function forgetPasswordAction(){
        $v = new View("user_forgetPassword", "front");
    }
}