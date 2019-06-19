<?php

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;

class Albums extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function getFormAlbum()
    {
        return [
            "create" => [
                "config" => [
                    "action" => Routing::getSlug("Albums", "createAlbum"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Ajouter un nouvel album',
                    'action_type' => 'create'
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Ajouter",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                "data" => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    "title" => [
                        "type" => "text",
                        "name" => "title",
                        "label" => "Nom de l'albmu",
                        "class" => "input-control",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 50,
                        "error" => "Votre catégorie doit faire entre 2 et 60 caractères"
                    ],

                    'cover_dir' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "cover_dir",
                        "label" => "Image de banière",
                        "class" => ""
                    ],

                    "separator1" => [
                        "type" => "separator",
                        "after_title" => "Médias"
                    ],
                    'deezer' => [
                        'type' => 'text',
                        'name' => 'deezer',
                        'label' => 'Lien deezer',
                        "required" => true,
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'spotify' => [
                        'type' => 'text',
                        'name' => 'spotify',
                        'label' => 'Lien spotify',
                        "required" => true,
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],

                    "separator2" => [
                        "type" => "separator",
                        "after_title" => "SEO"
                    ],
                    "slug" => [
                        "type" => "slug",
                        "label" => "Lien permanent",
                        "class" => "title-value-slug",
                        "presed" => $_SERVER['SERVER_NAME'],
                        "id" => "slug",
                        "name" => "slug",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "label" => "Description",
                        "id" => "description",
                        "name" => "description",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
                    ],


                ]
            ],
            'update' => [
                "config" => [
                    "action" => Routing::getSlug("Categories", "updateArticle"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Modification catégorie',
                    'action_type' => 'update'
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Modifé",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                "data" => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    "name" => [
                        "type" => "text",
                        "placeholder" => "Saisissez une catégorie",
                        "class" => "input-control",
                        "name" => "name",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 50,
                        "error" => "Votre catégorie doit faire entre 2 et 60 caractères"
                    ]

                ]
            ]
        ];
    }
}
