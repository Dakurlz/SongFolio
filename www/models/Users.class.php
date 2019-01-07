<?php
class Users extends BaseSQL{

	public $id = null;
	public $firstname;
	public $lastname;
	public $email;
	public $pwd;
	public $status = 0;
	public $role = 1;

	public function __construct(){
		parent::__construct();
	}

	public function setId($id){
		$this->id=$id;
		//Alimentation de l'objet (this) depuis la bdd ou l'id correspond
		$this->getOneBy(["id"=>$id], true);
	}
	public function setFirstname($firstname){
		$this->firstname=ucwords(strtolower(trim($firstname)));
	}
	public function setLastname($lastname){
		$this->lastname=strtoupper(trim($lastname));
	}
	public function setEmail($email){
		$this->email=strtolower(trim($email));
	}
	public function setPwd($pwd){
		$this->pwd=password_hash($pwd, PASSWORD_DEFAULT);
	}
	public function setStatus($status){
		$this->status=$status;
	}
	public function setRole($role){
		$this->role=$role;
	}


	public function getFormRegister (){
		return [
					"config"=>[
									"action"=>Routing::getSlug("Users", "add"),
									"method"=>"POST",
									"class"=>"",
									"id"=>"",
									"reset"=>"Annuler",
									"submit"=>"S'enregistrer"
								],
					"data"=>[
						"firstname"=>[
										"type"=>"text",
										"placeholder"=>"Votre prénom",
										"class"=>"form-control",
										"id"=>"firstname",
										"required"=>true
									],
						"lastname"=>[
										"type"=>"text",
										"placeholder"=>"Votre nom",
										"class"=>"form-control",
										"id"=>"lastname",
										"required"=>true],
						"email"=>[
										"type"=>"email",
										"placeholder"=>"Votre email",
										"class"=>"form-control",
										"id"=>"email",
										"required"=>true],
						"pwd"=>[
										"type"=>"password",
										"placeholder"=>"Votre mot de passe",
										"class"=>"form-control",
										"id"=>"pwd",
										"required"=>true],
						"pwdConfirm"=>[
										"type"=>"password",
										"placeholder"=>"Confirmation",
										"class"=>"form-control",
										"id"=>"pwdConfirm",
										"required"=>true],
					]
				];
	}


}







