<?php

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Core\View;
use Songfolio\Core\Helper;

class Events extends BaseSQL
{
    private $comments;
    private $categories;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->comments = new Comments();
        $this->categories = new Categories();
    }

    public function show()
    {
        $v = new View("events/event", "front");
        $categories = $this->categories->getAllBy(['type' => 'event']);
        $this->__set('type', Helper::searchInArray($categories, $this->__get('type'), 'name'));

        if ($this->__get('comment_active') === '1') {
            $comments = $this->comments->prepareComments('events', $this->__get('id'));
            $v->assign('comments', $comments);
        }


        $v->assign('event', $this);
    }


    public function getFormEvents(): array
    {
        return [
            'create' => [
                "config" => [
                    "action" => Routing::getSlug("Events", "createEvents"),
                    "method" => "POST",
                    'header' => 'Ajouter un nouvel évènement',
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
                    'name_event' => [
                        'name' => 'displayName',
                        'type' => 'text',
                        'label' => 'Titres d\'événement',
                        'placeholder' => '',
                        'required' => true,
                        'minlength' => 2,
                        'maxlength' => 200,
                        'error' => 'Votre titre doit faire entre 2 et 200 caractères',
                        "class" => "input-control col-lg-5 col-md-5 col-sm-5 col-12 target-elment-to-slug",

                    ],
                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],
                    'status' => [
                        'type' => 'text',
                        'name' => 'status',
                        'label' => 'Statut',
                        "required" => true,
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'start_row_start_date' => [
                        'type' => 'start_row'
                    ],
                    'start_date' => [
                        'type' => 'date',
                        'label' => 'Date de debut',
                        'name' => 'start_date',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'start_time' => [
                        'type' => 'time',
                        'label' => 'L\'heure de debut',
                        'name' => 'start_time',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'end_row_start_date' => [
                        'type' => 'end_row'
                    ],

                    'start_row_end_date' => [
                        'type' => 'start_row'
                    ],
                    'end_date' => [
                        'type' => 'date',
                        'label' => 'Date de fin',
                        'name' => 'end_date',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'end_time' => [
                        'type' => 'time',
                        'label' => 'L\'heure de fin',
                        'name' => 'end_time',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'end_row_end_date' => [
                        'type' => 'end_row'
                    ],

                    'img' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image de banière",
                        "class" => ""
                    ],

                    'rate' => [
                        'type' => 'number',
                        'name' => 'rate',
                        "required" => true,
                        "label" => "Prix",
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'nbr_place' => [
                        'type' => 'number',
                        'name' => 'nbr_place',
                        "required" => true,
                        "label" => "Nombre de place",
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'ticketing' => [
                        'type' => 'text',
                        'name' => 'ticketing',
                        'label' => 'Billetterie externe',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'address' => [
                        'type' => 'text',
                        'label' => 'Adresse',
                        'name' => 'address',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'postal_code' => [
                        'type' => 'text',
                        'class' => 'form-control',
                        'label' => 'Postal code',
                        'name' => 'postal_code',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'city' => [
                        'type' => 'text',
                        'label' => 'Ville',
                        'class' => 'form-control',
                        'name' => 'city',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'details' => [
                        "type" => "textarea",
                        "label" => "Détail",
                        "id" => "details",
                        "name" => "details",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
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
                    'comment_active' => [
                        'type' => 'checkbox',
                        'id' => 'comment_active',
                        "name" => "comment_active",
                        'label' => 'Autoriser les commentaires',
                        "div_class" => "smart-type type-article",
                        "required" => false,
                    ],
                ]
            ],
            'update' => [
                "config" => [
                    "action" => Routing::getSlug("Events", "updateEvents"),
                    "method" => "POST",
                    'header' => 'Modifi l\'évènement',
                    'action_type' => 'update',
                    'current_object' => $this
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Modifier",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                "data" => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    'name_event' => [
                        'name' => 'displayName',
                        'type' => 'text',
                        'label' => 'Titres d\'événement',
                        'placeholder' => '',
                        'required' => true,
                        'minlength' => 2,
                        'maxlength' => 200,
                        'error' => 'Votre titre doit faire entre 2 et 200 caractères',
                        "class" => "input-control col-lg-5 col-md-5 col-sm-5 col-12 target-elment-to-slug",

                    ],
                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],
                    'status' => [
                        'type' => 'text',
                        'name' => 'status',
                        'label' => 'Statut',
                        "required" => true,
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'start_row_start_date' => [
                        'type' => 'start_row'
                    ],
                    'start_date' => [
                        'type' => 'date',
                        'label' => 'Date de debut',
                        'name' => 'start_date',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'start_time' => [
                        'type' => 'time',
                        'label' => 'L\'heure de debut',
                        'name' => 'start_time',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'end_row_start_date' => [
                        'type' => 'end_row'
                    ],

                    'start_row_end_date' => [
                        'type' => 'start_row'
                    ],
                    'end_date' => [
                        'type' => 'date',
                        'label' => 'Date de fin',
                        'name' => 'end_date',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'end_time' => [
                        'type' => 'time',
                        'label' => 'L\'heure de fin',
                        'name' => 'end_time',
                        "required" => true,
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6'
                    ],
                    'end_row_end_date' => [
                        'type' => 'end_row'
                    ],

                    'img' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image de banière",
                        "class" => ""
                    ],
                    'ticketing' => [
                        'type' => 'text',
                        'name' => 'ticketing',
                        'label' => 'Billetterie externe',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'rate' => [
                        'type' => 'number',
                        'name' => 'rate',
                        "required" => true,
                        "label" => "Prix",
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'nbr_place' => [
                        'type' => 'number',
                        'name' => 'nbr_place',
                        "required" => true,
                        "label" => "Nombre de place",
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'address' => [
                        'type' => 'text',
                        'label' => 'Adresse',
                        'name' => 'address',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'postal_code' => [
                        'type' => 'text',
                        'class' => 'form-control',
                        'label' => 'Postal code',
                        'name' => 'postal_code',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'city' => [
                        'type' => 'text',
                        'label' => 'Ville',
                        'class' => 'form-control',
                        'name' => 'city',
                        'required' => true,
                        'class' => 'form-control  col-lg-4 col-md-4 col-sm-4 col-12',
                    ],
                    'details' => [
                        "type" => "textarea",
                        "label" => "Détail",
                        "id" => "details",
                        "name" => "details",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
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
                    'comment_active' => [
                        'type' => 'checkbox',
                        'id' => 'comment_active',
                        "name" => "comment_active",
                        'label' => 'Autoriser les commentaires',
                        "div_class" => "smart-type type-article",
                        "required" => false,
                    ],
                ]
            ]
        ];
    }
}
