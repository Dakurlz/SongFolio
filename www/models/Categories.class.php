<?php

class Categories extends Model
{
    public $name;
    public $slug;
    public $rank = null;

    public function __construct($id = null)
    {
      parent::__construct($id);
    }

    public function setName($name)
    {
        $this->name = trim($name);
    }

    public function setSlug($slug)
    {
        $this->slug = trim($slug);
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
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
