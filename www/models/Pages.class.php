<?php

class Pages extends Model
{
    public $type;
    public $slug;
    public $cat_id;
    public $title;
    public $description;
    public $content;
    public $header;
    public $author;
    public $status;

    public function __construct($id = null)
    {
      parent::__construct($id);
    }

    public function setType($type)
    {
        $this->type = trim($type);
    }

    public function setCat_id($cat_id)
    {
        $this->cat_id = trim($cat_id);
    }

    public function setTitle($title)
    {
        $this->title = trim($title);
    }

    public function setDescription($description)
    {
        $this->description = trim($description);
    }
    public function setContent($content)
    {
        $this->content = trim($content);
    }

    public function setHeader($header)
    {
        $this->header = trim($header);
    }

    public function setAuthor($author)
    {
        $this->author = trim($author);
    }

    public function setSlug($slug)
    {
        $this->slug = trim($slug);
    }

    public function setStatus($status)
    {
        $this->status = trim($status);
    }


    public function getFormRegister(){
        return [
            "config"=>[
                "action"=>Routing::getSlug("Pages", "index"),
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
                "type"=>[
                    "type"=>"select",
                    "class"=>"select-control",
                    "label" => "Type",
                    "id"=>"type",
                    "placeholder"=>"",
                    "required"=>true,
                    "error"=>"Selectioner type",
                    "option"=> [
                        "Page", "Article", "Album",
                    ],
                ],
                "title"=>[
                    "type"=>"text",
                    "label" => "Titre",
                    "placeholder"=>"Votre titre",
                    "class"=>"input-control",
                    "id"=>"title",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Votre titre doit faire entre 2 et 100 caractères"
                ],
                "slug"=>[
                    "type"=>"text",
                    "label" => "Lien permanent",
                    "class"=>"input-control",
                    "id"=>"slug",
                    "placeholder"=>"",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Votre titre doit faire entre 2 et 100 caractères"
                ],
                "slug"=>[
                    "type"=>"text",
                    "label" => "Lien permanent",
                    "class"=>"input-control",
                    "id"=>"slug",
                    "placeholder"=>"",
                    "required"=>true,
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Votre titre doit faire entre 2 et 100 caractères"
                ],
              
            ]
        ];
    }
}
