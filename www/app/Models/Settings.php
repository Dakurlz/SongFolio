<?php

declare (strict_types = 1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Models\Menus;

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
        $path = explode("/", $value);

        $return = $this->__get('data');
        foreach($path as $val){
            if(!isset($return[$val])) {
                return '';
            }

            $return = $return[$val];
        }
        return $return ?? null;
    }

    public function get(){
        return $this->__get('data');
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
                    "text" => "Enregistrer",
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
                $menus = (new Menus())->getAllData();
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "header",
                        "required" => true
                    ],
                    "header_menu" => [
                        "type" => "select",
                        "class" => "col-4 smart-toggle",
                        "label" => "Menu du header",
                        "id" => "header_menu",
                        "name" => "data[header_menu]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Choisissez un menu",
                        "selected" => $this->getData('header_menu'),
                        "options" => [],
                    ],
                ];
                foreach($menus as $menu){
                    $array['data']['header_menu']['options'][] = ["label" => $menu['title'], "value" => $menu['id']];
                }
                break;

            case 'footer' :
                $menus = (new Menus())->getAllData();
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "footer",
                        "required" => true
                    ],
                    "footer_menu_nb" => [
                        "type" => "select",
                        "class" => "col-4 smart-toggle",
                        "label" => "Menu du header",
                        "id" => "footer-menu-nb",
                        "name" => "data[footer_menu_nb]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Nombre de colonnes du footer",
                        "selected" => $this->getData('footer_menu_nb'),
                        "options" => [
                            ["label" => '1', "value" => 1],
                            ["label" => '2', "value" => 2],
                            ["label" => '3', "value" => 3],
                            ["label" => '4', "value" => 4]
                        ],
                    ],
                    "footer_menu_1" => [
                        "type" => "select",
                        "class" => "col-4",
                        "div_class" => "smart-footer-menu-nb footer-menu-nb-1 footer-menu-nb-2 footer-menu-nb-3 footer-menu-nb-4",
                        "label" => "Menu 1",
                        "id" => "footer_menu_1",
                        "name" => "data[footer_menu][1]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Choisissez un menu",
                        "selected" => $this->getData('footer_menu/1'),
                        "options" => [],
                    ],
                    "footer_menu_2" => [
                        "type" => "select",
                        "class" => "col-4",
                        "div_class" => "smart-footer-menu-nb footer-menu-nb-2 footer-menu-nb-3 footer-menu-nb-4",
                        "label" => "Menu 2",
                        "id" => "footer_menu_2",
                        "name" => "data[footer_menu][2]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Choisissez un menu",
                        "selected" => $this->getData('footer_menu/2'),
                        "options" => [],
                    ],
                    "footer_menu_3" => [
                        "type" => "select",
                        "class" => "col-4",
                        "div_class" => "smart-footer-menu-nb footer-menu-nb-3 footer-menu-nb-4",
                        "label" => "Menu 3",
                        "id" => "footer_menu_3",
                        "name" => "data[footer_menu][3]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Choisissez un menu",
                        "selected" => $this->getData('footer_menu/3'),
                        "options" => [],
                    ],
                    "footer_menu_4" => [
                        "type" => "select",
                        "class" => "col-4",
                        "div_class" => "smart-footer-menu-nb footer-menu-nb-4",
                        "label" => "Menu 4",
                        "id" => "footer_menu_4",
                        "name" => "data[footer_menu][4]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Choisissez un menu",
                        "selected" => $this->getData('footer_menu/4'),
                        "options" => [],
                    ],
                ];
                foreach($menus as $menu){
                    $array['data']['footer_menu_1']['options'][] = ["label" => $menu['title'], "value" => $menu['id']];
                    $array['data']['footer_menu_2']['options'] = $array['data']['footer_menu_1']['options'];
                    $array['data']['footer_menu_3']['options'] = $array['data']['footer_menu_1']['options'];
                    $array['data']['footer_menu_4']['options'] = $array['data']['footer_menu_1']['options'];
                }
                break;
        }
        return $array;
    }
}
