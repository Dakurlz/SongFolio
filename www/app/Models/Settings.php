<?php

declare (strict_types = 1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Models\Menus;
use Songfolio\Core\Helper;

class Settings extends BaseSQL
{
    static $settingsSingleton;

    public function __construct($settings_type)
    {
            parent::__construct(['type' => $settings_type]);
            if(!$this->id()){
                $this->__set('type', $settings_type);
            }
    }

    public static function get($settings_type){
        if(!isset(self::$settingsSingleton[$settings_type])) {
            $setting = new Settings($settings_type);
            self::$settingsSingleton[$settings_type] = $setting;
        }
        return self::$settingsSingleton[$settings_type];

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
        return $return ?? false;
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
                        "value" => $this->getData('site_tags')
                    ],
                    "fb_url" => [
                        "type" => "text",
                        "label" => "Lien vers votre page facebook",
                        "class" => "form-control",
                        "name" => "data[fb_url]",
                        "value" => $this->getData('fb_url')
                    ],
                    "twitter_url" => [
                        "type" => "text",
                        "label" => "Lien vers votre page twitter",
                        "class" => "form-control",
                        "name" => "data[twitter_url]",
                        "value" => $this->getData('twitter_url')
                    ],
                    "insta_url" => [
                        "type" => "text",
                        "label" => "Lien vers votre page instagram",
                        "class" => "form-control",
                        "name" => "data[insta_url]",
                        "value" => $this->getData('insta_url')
                    ],
                    "separator-oauth-fb" => [
                        "type" => "separator",
                        "after_title" => "Login with Facebook"
                    ],
                    "oauth_id_Facebook" => [
                        "type" => "text",
                        "label" => "ID application facebook",
                        "class" => "form-control",
                        "name" => "data[oauth][Facebook][client_id]",
                        "value" => $this->getData('oauth/Facebook/client_id')
                    ],
                    "client_secret_Facebook" => [
                        "type" => "text",
                        "label" => "Clef secrete application facebook",
                        "class" => "form-control",
                        "name" => "data[oauth][Facebook][client_secret]",
                        "value" => $this->getData('oauth/Facebook/client_secret')
                    ],
                    "separator-oauth-fb" => [
                        "type" => "separator",
                        "after_title" => "Login with Google"
                    ],
                    "oauth_id_Google" => [
                        "type" => "text",
                        "label" => "ID application Google",
                        "class" => "form-control",
                        "name" => "data[oauth][Google][client_id]",
                        "value" => $this->getData('oauth/Google/client_id')
                    ],
                    "client_secret_Google" => [
                        "type" => "text",
                        "label" => "Clef secrete application Google",
                        "class" => "form-control",
                        "name" => "data[oauth][Google][client_secret]",
                        "value" => $this->getData('oauth/Google/client_secret')
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
                    "text_color" => [
                        "type" => "color",
                        "label" => "Couleur du texte",
                        "class" => "form-control",
                        "name" => "data[text_color]",
                        "value" => $this->getData('text_color') ?? "#ffffff",
                        "required" => true
                    ],
                    "text_font_name" => [
                        "type" => "select",
                        "class" => "form-control",
                        "label" => "Police du texte",
                        "id" => "text_font_name",
                        "name" => "data[text_font_name]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Vous devez choisir une police de texte.",
                        "selected" => $this->getData('text_font_name'),
                        "options" => [],
                    ],
                    "title_color" => [
                        "type" => "color",
                        "label" => "Couleur des titres",
                        "class" => "form-control",
                        "name" => "data[title_color]",
                        "value" => $this->getData('title_color') ?? "#ffffff",
                        "required" => true
                    ],
                    "title_font_name" => [
                        "type" => "select",
                        "class" => "form-control",
                        "label" => "Police des titres",
                        "id" => "title_font_name",
                        "name" => "data[title_font_name]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Vous devez choisir une police de titre.",
                        "selected" => $this->getData('title_font_name'),
                        "options" => [],
                    ],
                    "link_color" => [
                        "type" => "color",
                        "label" => "Couleur des liens",
                        "class" => "form-control",
                        "name" => "data[link_color]",
                        "value" => $this->getData('link_color') ?? "#ffffff",
                        "required" => true
                    ],
                    "separator-header" => [
                        "type" => "separator",
                        "after_title" => "Header"
                    ],
                    "header_background" => [
                        "type" => "color",
                        "label" => "Couleur de fond du header",
                        "class" => "form-control",
                        "name" => "data[header_background]",
                        "value" => $this->getData('header_background') ?? "#ffffff",
                        "required" => true
                    ],
                    "header_link_color" => [
                        "type" => "color",
                        "label" => "Couleur des liens du header",
                        "class" => "form-control",
                        "name" => "data[header_link_color]",
                        "value" => $this->getData('header_link_color') ?? "#ffffff",
                        "required" => true
                    ],
                    "separator-footer" => [
                        "type" => "separator",
                        "after_title" => "Footer"
                    ],
                    "footer_background" => [
                        "type" => "color",
                        "label" => "Couleur de fond du footer",
                        "class" => "form-control",
                        "name" => "data[footer_background]",
                        "value" => $this->getData('footer_background') ?? "#ffffff",
                        "required" => true
                    ],
                    "footer_title_color" => [
                        "type" => "color",
                        "label" => "Couleur des titres du footer",
                        "class" => "form-control",
                        "name" => "data[footer_title_color]",
                        "value" => $this->getData('footer_title_color') ?? "#ffffff",
                        "required" => true
                    ],
                    "footer_link_color" => [
                        "type" => "color",
                        "label" => "Couleur des liens du footer",
                        "class" => "form-control",
                        "name" => "data[footer_link_color]",
                        "value" => $this->getData('footer_link_color') ?? "#ffffff",
                        "required" => true
                    ],
                ];
                foreach(Helper::getGoogleFonts() as $font_name){
                    $array['data']['title_font_name']['options'][] = ["label" => $font_name, "value" => $font_name];
                }
                $array['data']['text_font_name']['options'] = $array['data']['title_font_name']['options'];
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
                    "header_logo" => [
                        "type" => "text",
                        "label" => "Logo du site",
                        "class" => "form-control",
                        "name" => "data[header_logo]",
                        "value" => $this->getData('header_logo')
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
                    ]
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
                        "label" => "Nombre de colonnes dans le footer",
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
                        "label" => "Menu footer colonne 1",
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
                        "label" => "Menu footer colonne 2",
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
                        "label" => "Menu footer colonne 3",
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
                        "label" => "Menu footer colonne 4",
                        "id" => "footer_menu_4",
                        "name" => "data[footer_menu][4]",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Choisissez un menu",
                        "selected" => $this->getData('footer_menu/4'),
                        "options" => [],
                    ],
                    "copyright" => [
                        "type" => "text",
                        "label" => "copyright du bas de page",
                        "placeholder" => "copyright",
                        "class" => "form-control",
                        "name" => "data[copyright]",
                        "value" => $this->getData('copyright'),
                        "required" => true
                    ],
                ];
                foreach($menus as $menu){
                    $array['data']['footer_menu_1']['options'][] = ["label" => $menu['title'], "value" => $menu['id']];
                    $array['data']['footer_menu_2']['options'] = $array['data']['footer_menu_1']['options'];
                    $array['data']['footer_menu_3']['options'] = $array['data']['footer_menu_1']['options'];
                    $array['data']['footer_menu_4']['options'] = $array['data']['footer_menu_1']['options'];
                }
                break;
            case 'mail' :
                $array['data'] = [
                    "setting_type" => [
                        "type" => "hidden",
                        "name" => "data[setting_type]",
                        "value" => "mail",
                        "required" => true
                    ],
                    "smtp_mail" => [
                        "type" => "text",
                        "label" => "Hôte SMTP",
                        "class" => "form-control",
                        "name" => "data[smtp_mail]",
                        "value" => $this->getData('SMTPSecure'),
                    ],
                    "username_mail" => [
                        "type" => "text",
                        "label" => "Nom du compte",
                        "class" => "form-control",
                        "name" => "data[username_mail]",
                        "value" => $this->getData('username_mail'),
                    ],
                    "userpassword_mail" => [
                        "type" => "password",
                        "label" => "Mot de passe",
                        "class" => "form-control",
                        "name" => "data[userpassword_mail]",
                        "value" => $this->getData('userpassword_mail'),
                    ], "SMTPSecure" => [
                        "type" => "text",
                        "label" => "SMTPSecure",
                        "class" => "form-control",
                        "name" => "data[SMTPSecure]",
                        "value" => $this->getData('SMTPSecure'),
                    ],
                    "Port" => [
                        "type" => "text",
                        "label" => "Port",
                        "class" => "form-control",
                        "name" => "data[Port]",
                        "value" => $this->getData('Port'),
                    ],

                ];
                break;


        }
        return $array;
    }
}
