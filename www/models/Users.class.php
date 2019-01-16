<?php
class Users extends BaseSQL{

    public function __construct($id = null){
        parent::__construct($id);
    }
	
	public function normalize($attr, $value){
		switch($attr){
			case 'firstname' :
				return ucwords(strtolower(trim($value)));
			break;
			case 'lastname' :
				return strtoupper(trim($value));
			break;
			case 'email' :
				return strtolower(trim($email));
			break;
			case 'password' :
				return password_hash($pwd,PASSWORD_DEFAULT);
			break;
		}
	}

    public function getFormRegister(){
        return [
            "config"=>[
                "action"=>Routing::getSlug("Users","register"),
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
                    "required"=>true
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control",
                    "id"=>"email",
                    "required"=>true
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control",
                    "id"=>"pwd",
                    "required"=>true
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "class"=>"form-control",
                    "id"=>"pwdConfirm",
                    "required"=>true
                ]
            ]

        ];
    }

}
