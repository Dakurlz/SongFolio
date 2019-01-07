<?php
class Users extends BaseSQL{

  public $user_id = null;
  public $user_username;
	public $user_firstname;
	public $user_lastname;
	public $user_email;
	public $user_password;
  public $user_status = 0;
  public $user_date_visit;
	public $user_role = 1;

	public function __construct(){
		parent::__construct();
	}

	public function setId($id){
		$this->id=$id;
		//Alimentation de l'objet (this) depuis la bdd ou l'id correspond
		$this->getOneBy(["user_id"=>$id], true);
  }
  public function setUsername($username){
    $this->user_username=trim($user_username);
  }
	public function setFirstname($firstname){
		$this->user_firstname=ucwords(strtolower(trim($user_firstname)));
	}
	public function setLastname($lastname){
		$this->user_lastname=strtoupper(trim($lastname));
	}
	public function setEmail($email){
		$this->user_email=strtolower(trim($email));
	}
	public function setPwd($pwd){
		$this->user_password=password_hash($pwd, PASSWORD_DEFAULT);
	}
	public function setStatus($status){
		$this->user_status=$status;
	}
	public function setRole($role){
		$this->user_role=$role;
	}
	public function setDateVisit($dateVisit){
		$this->user_date_visit=trim($dateVisit);
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







