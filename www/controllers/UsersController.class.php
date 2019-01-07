<?php
class UsersController{


	public function defaultAction(){
		echo "User default";
	}


	public function addAction(){
	
		$user = new Users();
		$user->setId(2);
		$user->setFirstname("Yves");
		$user->save();
		


		$v = new View("addUser", "front");
		
	}

	public function loginAction(){
	
		$v = new View("loginUser", "front");
		
	}

	public function forgetPasswordAction(){

		$v = new View("forgetPasswordUser", "front");
		
	}

}
