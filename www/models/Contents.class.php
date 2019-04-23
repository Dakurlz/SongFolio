<?php

class Contents extends BaseSQL
{

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function customSet($attr, $value)
    {
        return trim($value);
    }


    public function getFormRegister()
    {
        return [
            "config" => [
                "action" => Routing::getSlug("Contents", "index"),
                "method" => "POST",
                "class" => "",
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Ajouter",
                    "class" => "btn btn-success-outline"
                ],
            ],
            "data" => [
                "type" => [
                    "type" => "select",
                    "class" => "col-4",
                    "label" => "Type",
                    "id" => "type",
                    "placeholder" => "",
                    "required" => true,
                    "error" => "Selectioner type",
                    "options" => [
                        ["label" => "Page", "value" => "page"],
                        ["label" => "Article", "value" => "article"],
                    ],
                ],
                "title" => [
                    "type" => "text",
                    "label" => "Titre",
                    "placeholder" => "Votre titre",
                    "class" => "input-control col-4",
                    "id" => "title",
                    "required" => true,
                    "minlength" => 2,
                    "maxlength" => 100,
                    "error" => "Votre titre doit faire entre 2 et 100 caractères"
                ],
                "description" => [
                    "type" => "textarea",
                    "label" => "Description",
                    "class" => "test lol",
                    "id" => "description",
                    "placeholder" => "",
                    "required" => true,
                    "error" => "Votre titre doit faire entre 2 et 100 caractères"
                ],
                "slug" => [
                    "type" => "slug",
                    "label" => "Lien permanent",
                    "class" => "",
                    "presed"=>$_SERVER['SERVER_NAME'],
                    "id" => "slug",
                    "placeholder" => "",
                    "required" => true,
                    "minlength" => 2,
                    "maxlength" => 100,
                    "error" => "Votre titre doit faire entre 2 et 100 caractères"
                ],

                "file" => [
                    "type" => "file",
                    "id" => "fileToUpload",
                    "required" => true,
                    "label" => "Ajouter une image",
                    "class" => ""
                ],

                "content" => [
                    "type" => "textarea",
                    "label" => "Contenue",
                    "class" => "textare-control editor",
                    "id" => "content",
                    "placeholder" => "",
                    "required" => true,
                    "minlength" => 2,
                    "maxlength" => 100,
                    "error" => "Votre titre doit faire entre 2 et 100 caractères"
                ],

            ]
        ];
    }
}
