<?php

namespace Songfolio\Models;
use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;

class Events extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
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
                        "class" => "input-control col-lg-5 col-md-5 col-sm-5 col-12",

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
                    'details' => [
                        "type" => "textarea",
                        "label" => "Détail",
                        "id" => "details",
                        "name" => "details",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
                    ],
                    'rate' => [
                        'type' => 'number',
                        'name' => 'rate',
                        "required" => true,
                        "label" => "Prix",
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
                    ]
                ]
            ],
            'update' => [
                "config" => [
                    "action" => Routing::getSlug("Events", "updateEvents"),
                    "method" => "POST",
                    'header' => 'Modifi l\'évènement',
                    'action_type' => 'update'
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
                        "class" => "input-control col-lg-5 col-md-5 col-sm-5 col-12",

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
                    'details' => [
                        "type" => "textarea",
                        "label" => "Détail",
                        "id" => "details",
                        "name" => "details",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
                    ],
                    'rate' => [
                        'type' => 'number',
                        'name' => 'rate',
                        "required" => true,
                        "label" => "Prix",
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
                    ]
                ]
            ]
        ];
    }

}