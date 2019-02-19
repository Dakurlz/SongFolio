<?php
class User extends BaseSQL{

    public function __construct($id = null){
        parent::__construct($id);
    }
	
	public function normalize($attr, $value){
		switch($attr){
			case 'username' :
				return ucfirst(strtolower(trim($value)));
			break;
			case 'email' :
				return strtolower(trim($value));
			break;
			case 'password' :
				return password_hash($value,PASSWORD_DEFAULT);
			break;
		}
	}

    public function getFormRegister(){
        return [
            "config"=>[
                "action"=>Routing::getSlug("Users", "register"),
                "method"=>"POST",
                "class"=>"",
                "id"=>"",
                "reset"=>"Annuler",
                "submit"=>"S'enregistrer"
            ],
            "data"=>[
                "username"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre pseudo",
                    "class"=>"form-control",
                    "id"=>"username",
                    "required"=>true,
                    "minlength"=>4,
                    "maxlength"=>50,
                    "error"=>"Votre pseudo doit faire entre 4 et 50 caractères"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control",
                    "id"=>"email",
                    "required"=>true,
                    "minlength"=>7,
                    "maxlength"=>250,
                    "error"=>"Votre email est incorrect ou fait plus de 250 caractères"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control",
                    "id"=>"pwd",
                    "required"=>true,
                    "minlength"=>6,
                    "error"=>"Votre mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres"
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "class"=>"form-control",
                    "id"=>"pwdConfirm",
                    "required"=>true,
                    "confirm"=>"pwd",
                    "error"=>"Le mot de passe de confirmation ne correspond pas"
                ],
            ]
        ];
    }

}
