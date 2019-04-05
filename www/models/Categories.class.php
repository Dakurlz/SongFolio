<?php

class Categories extends BaseSQL
{
    public function __construct($id = null)
    {
      parent::__construct($id);
    }

    public function getFormRegister(){
        return [
            "config"=>[
                "action"=>Routing::getSlug("Categories", "index"),
                "method"=>"POST",
                "class"=>"",
            ],
            "btn" =>[
                "submit" =>[
                    "type"=>"submit",
                    "text"=>"Ajouter",
                    "class"=>"btn btn-success-outline"
                ],
            ],
            "data"=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Saisissez une catégorie",
                    "class"=>"input-control",
                    "id"=>"name",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>60,
                    "error"=>"Votre catégorie doit faire entre 2 et 60 caractères"
                ]
              
            ]
        ];
    }
}
