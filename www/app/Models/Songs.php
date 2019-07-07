<?php

declare(strict_types=1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Core\View;

class Songs extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function getSlug(string $id, string $slug)
    {
        return $this->getByCustomQuery(['id' => $id, 'slug' => $slug], 'id, slug');
    }

    public function show()
    {


        $view = new View("songs/song", "front");

        $view->assign('song', $this);
    }

    public function getFormSongs()
    {
        return [
            "create" => [
                "config" => [
                    "action" => Routing::getSlug("Songs", "create"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Ajouter un morceau',
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

                    "name" => [
                        "type" => "text",
                        "name" => "name",
                        "placeholder" => "Titre ",
                        "class" => "input-control target-elment-to-slug",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 50,
                        "error" => "Votre catégorie doit faire entre 2 et 60 caractères"
                    ],

                    "type" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Ce morceau fait il un partie d'un album",
                        "id" => "type",
                        "name" => "type",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Ce morceau fait il un partie d'un album",
                        "options" => [
                            ["label" => "Non", "value" => "non"],
                            ["label" => "Oui", "value" => "yes"],
                        ],
                    ],

                    "album" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Album",
                        "div_class" => "smart-type type-yes",
                        "id" => "album",
                        "name" => "album",
                        "placeholder" => "",
                        "required" => false,
                        "error" => "Selectioner un album",
                        "options" => [],
                    ],

                    "content" => [
                        "type" => "textarea",
                        "label" => "Parole du morceau",
                        "class" => "textare-control editor",
                        "id" => "content",
                        "name" => "text",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 5000,
                        "error" => "Votre text doit faire entre 2 et 2000 caractères"
                    ],


                    "img-page" => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image de morceau (Taille conseillée : 1920x380px)",
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
                    'youtube' => [
                        'type' => 'text',
                        'name' => 'youtube',
                        'label' => 'Lien youtube',
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
            "update" => [
                "config" => [
                    "action" => Routing::getSlug("Songs", "updateSong"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Modifié un morceau',
                    'action_type' => 'update',
                    'current_object' => $this
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Modifié",
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
                        "name" => "name",
                        "placeholder" => "Titre ",
                        "class" => "input-control target-elment-to-slug",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 50,
                        "error" => "Votre catégorie doit faire entre 2 et 60 caractères"
                    ],

                    "type" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Ce morceau fait il un partie d'un album",
                        "id" => "type",
                        "name" => "type",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Ce morceau fait il un partie d'un album",
                        "options" => [
                            ["label" => "Non", "value" => "non"],
                            ["label" => "Oui", "value" => "yes"],
                        ],
                    ],

                    "album" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Album",
                        "div_class" => "smart-type type-yes",
                        "id" => "album",
                        "name" => "album",
                        "placeholder" => "",
                        "required" => false,
                        "error" => "Selectioner un album",
                        "options" => [],
                    ],

                    "content" => [
                        "type" => "textarea",
                        "label" => "Parole du morceau",
                        "class" => "textare-control editor",
                        "id" => "content",
                        "name" => "text",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 2000,
                        "error" => "Votre text doit faire entre 2 et 2000 caractères"
                    ],


                    "img-page" => [
                        "type" => "file",
                        "div_class" => "smart-type type-page",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image de morceau (Taille conseillée : 1920x380px)",
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
                    'youtube' => [
                        'type' => 'text',
                        'name' => 'youtube',
                        'label' => 'Lien youtube',
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
            ]
        ];
    }
}
