<?php

namespace app\Models;

use app\Core\BaseSQL;
use app\Core\Routing;

class Categories extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function getFormAlbumCategories()
    {
        return [
            "config" => [
                "action" => Routing::getSlug("Categories", "album"),
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
                "name" => [
                    "type" => "text",
                    "placeholder" => "Saisissez une catégorie",
                    "class" => "input-control",
                    "id" => "name",
                    "required" => true,
                    "minlength" => 2,
                    "maxlength" => 50,
                    "error" => "Votre catégorie doit faire entre 2 et 60 caractères"
                ]

            ]
        ];
    }

    public function getFormArticleCategories()
    {
        return [
            "config" => [
                "action" => Routing::getSlug("Categories", "index"),
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
                "name" => [
                    "type" => "text",
                    "placeholder" => "Saisissez une catégorie",
                    "class" => "input-control",
                    "id" => "name",
                    "required" => true,
                    "minlength" => 2,
                    "maxlength" => 60,
                    "error" => "Votre catégorie doit faire entre 2 et 60 caractères"
                ],
                "slug" => [
                    "type" => "slug",
                    "label" => "Lien permanent",
                    "class" => "",
                    "presed" => $_SERVER['SERVER_NAME'] . '/',
                    "id" => "slug",
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
