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

    
    /**
     * @param array $categories
     * @return array
     */
    public static function prepareAlbumToSelect(array $albums): array
    {
        $arr = [];
        foreach ($albums as $album){
            $arr[] = ['label' => $album['title'], 'value' => $album['id']];
        }

        return $arr;
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
                    'action_type' => 'create',
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
                        "class" => "input-control target-elment-to-slug",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 1,
                        "maxlength" => 50,
                        "error" => "Votre catégorie doit faire entre 1 et 60 caractères"
                    ],

                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category_id",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],

                    'cover_dir' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
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
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'spotify' => [
                        'type' => 'text',
                        'name' => 'spotify',
                        'label' => 'Lien spotify',
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
                        "minlength" => 1,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 1 et 100 caractères"
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
                    "action" => Routing::getSlug("Albums", "updateAlbum"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Modifé un nouvel album',
                    'action_type' => 'update',
                    'current_object' => $this

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
                    "title" => [
                        "type" => "text",
                        "name" => "title",
                        "label" => "Nom de l'albmu",
                        "class" => "input-control target-elment-to-slug",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 1,
                        "maxlength" => 50,
                        "error" => "Votre titre doit faire entre 1 et 60 caractères"
                    ],

                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category_id",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],

                    'cover_dir' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
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
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'spotify' => [
                        'type' => 'text',
                        'name' => 'spotify',
                        'label' => 'Lien spotify',
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
                        "minlength" => 1,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 1 et 100 caractères"
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
            ]
        ];
    }
}
