<?php

declare (strict_types = 1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;

class Settings extends BaseSQL
{
    public function __construct($settings_type)
    {
        parent::__construct(['type' => $settings_type]);
        if(!$this->id()){
            $this->__set('type', $settings_type);
        }
    }

    public function customSet($attr, $value)
    {
        switch ($attr) {
            case 'data':
                if (is_array($value)) {
                    return json_encode($value);
                }
                break;
        }

        return $value;
    }

    public function customGet($attr, $value)
    {
        switch ($attr) {
            case 'data':
                return json_decode($value, true);
                break;
        }

        return $value;
    }

    public function getData($value){
        $settings = $this->__get('data');
        return $settings[$value] ?? null;
    }

    public function getForm($setting_type)
    {
        $array = [
            "config" => [
                "action" => Routing::getSlug('Settings', 'save'),
                "method" => "POST",
                "class" => "",
                "id" => "",
                "submit" => "Connexion"
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Connexion",
                    "class" => "btn btn-success-outline"
                ],
            ]
        ];

        switch($setting_type){
            case 'config' :
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "config",
                        "required" => true
                    ],
                    "site_name" => [
                        "type" => "text",
                        "label" => "Nom du site",
                        "placeholder" => "Nom du site",
                        "class" => "form-control",
                        "name" => "data[site_name]",
                        "value" => $this->getData('site_name'),
                        "required" => true
                    ],
                    "site_desc" => [
                        "type" => "text",
                        "label" => "Description courte du site",
                        "placeholder" => "Description courte du site",
                        "class" => "form-control",
                        "name" => "data[site_desc]",
                        "value" => $this->getData('site_desc'),
                        "required" => true
                    ],
                    "site_tags" => [
                        "type" => "text",
                        "label" => "Tags (séparés par des virgules)",
                        "placeholder" => "Séparés par des virgules",
                        "class" => "form-control",
                        "name" => "data[site_tags]",
                        "value" => $this->getData('site_tags'),
                        "required" => true
                    ]
                ];
                break;
            case 'template' :
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "template",
                        "required" => true
                    ],
                    "site_name" => [
                        "type" => "text",
                        "label" => "Nom  2 du site",
                        "placeholder" => "Nom du site",
                        "class" => "form-control",
                        "name" => "data[site_name]",
                        "value" => $this->getData('site_name'),
                        "required" => true
                    ],
                    "site_desc" => [
                        "type" => "text",
                        "label" => "Descr DD iption courte du site",
                        "placeholder" => "Description courte du site",
                        "class" => "form-control",
                        "name" => "data[site_desc]",
                        "value" => $this->getData('site_desc'),
                        "required" => true
                    ],
                    "site_tags" => [
                        "type" => "text",
                        "label" => "Tags (séparés par des virgules)",
                        "placeholder" => "Séparés par des virgules",
                        "class" => "form-control",
                        "name" => "data[site_tags]",
                        "value" => $this->getData('site_tags'),
                        "required" => true
                    ]
                ];
                break;

            case 'header' :
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "header",
                        "required" => true
                    ]
                ];
                break;

            case 'footer' :
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "footer",
                        "required" => true
                    ]
                ];
                break;
        }
        return $array;
    }
}
