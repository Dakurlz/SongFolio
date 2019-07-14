<?php
declare (strict_types = 1);

namespace Songfolio\Core;

use Songfolio\Models\Settings;

class Install
{

    public function __construct()
    {

    }

    public function initDb($dbInfos){

        //Change config file
        $config_file = 'app/config/conf.inc.php';
        $config = file_get_contents($config_file);
        foreach($dbInfos as $key => $value){
            $config = preg_replace('#define\("'.strtoupper($key).'", "(.*?)"\);#', 'define("'.strtoupper($key).'", "'.$value.'");', $config);
        }
        file_put_contents($config_file, $config);

        //Install datas
        $db = new \PDO('mysql:host='.$dbInfos['db_host'].';dbname='.$dbInfos['db_name'], $dbInfos['db_user'], $dbInfos['db_password']);
        $sql = file_get_contents('app/config/install_datas.sql');

        try{
            $db->exec($sql);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function finishInstall(){
        fopen('app/config/.installed', 'w+');
    }

    public function getFormDb()
    {
        return [
            "config" => [
                "action" => Routing::getSlug("Install", "bdd"),
                "method" => "POST",
                "class" => "",
                "id" => ""
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Valider",
                    "class" => "btn btn-success-outline"
                ],
            ],
            "data" => [
                "db_host" => [
                    "type" => "text",
                    "placeholder" => "Serveur de la base",
                    "class" => "form-control",
                    "id" => "db_host",
                    "name" => "db[db_host]",
                    "value" => DB_HOST ?? '',
                    "required" => true,
                    "error" => "Le serveur hôte est obligatoire"
                ],
                "db_name" => [
                    "type" => "text",
                    "placeholder" => "Nom de la base",
                    "class" => "form-control",
                    "id" => "db_name",
                    "name" => "db[db_name]",
                    "value" => DB_NAME ?? '',
                    "required" => true,
                    "error" => "Le nom de la base de donnée est obligatoire"
                ],
                "db_user" => [
                    "type" => "text",
                    "placeholder" => "User BDD",
                    "class" => "form-control",
                    "id" => "db_user",
                    "name" => "db[db_user]",
                    "value" => DB_USER ?? '',
                    "required" => true,
                    "error" => "Le nom de l'utilisateur de la base de donnée est obligatoire"
                ],
                "db_password" => [
                    "type" => "password",
                    "placeholder" => "Mot de passe BDD",
                    "class" => "form-control",
                    "id" => "db_password",
                    "value" => DB_PASSWORD ?? '',
                    "name" => "db[db_password]",
                    "required" => true,
                    "error" => "Le mot de passe de la base de donnée est obligatoire"
                ]
            ]
        ];
    }

    public function getFormConfig()
    {
        $config = new Settings('config');
        return [
            "config" => [
                "action" => Routing::getSlug("Install", "config"),
                "method" => "POST",
                "class" => "",
                "id" => ""
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Valider",
                    "class" => "btn btn-success-outline"
                ],
            ],
            "data" => [
                "site_name" => [
                    "type" => "text",
                    "label" => "Nom du site",
                    "placeholder" => "Nom du site",
                    "class" => "form-control",
                    "name" => "data[site_name]",
                    "value" => $config->getData('site_name') ?? '',
                    "required" => true
                ],
                "site_desc" => [
                    "type" => "text",
                    "label" => "Description courte du site",
                    "placeholder" => "Description courte du site",
                    "class" => "form-control",
                    "name" => "data[site_desc]",
                    "value" => $config->getData('site_desc') ?? '',
                    "required" => true
                ],
                "site_tags" => [
                    "type" => "text",
                    "label" => "Tags (séparés par des virgules)",
                    "placeholder" => "Séparés par des virgules",
                    "class" => "form-control",
                    "name" => "data[site_tags]",
                    "value" => $config->getData('site_tags') ?? '',
                    "required" => true
                ]
            ]
        ];
    }

    public function getFormUser()
    {
        $config = new Settings('config');
        return [
            "config" => [
                "action" => Routing::getSlug("Install", "user"),
                "method" => "POST",
                "class" => "",
                "id" => ""
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Inscription",
                    "class" => "btn btn-success-outline"
                ],
            ],
            "data" => [
                "first_name" => [
                    "type" => "text",
                    "placeholder" => "Nom",
                    "class" => "form-control",
                    "id" => "first_name",
                    "name" => "first_name",
                    "required" => true,
                    "minlength" => 3,
                    "maxlength" => 50,
                    "error" => "Votre pseudo doit faire entre 3 et 50 caractères"
                ],
                "last_name" => [
                    "type" => "text",
                    "placeholder" => "Prénom",
                    "class" => "form-control",
                    "id" => "last_name",
                    "name" => "last_name",
                    "required" => true,
                    "minlength" => 3,
                    "maxlength" => 100,
                    "error" => "Votre pseudo doit faire entre 3 et 100 caractères"
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "class" => "form-control",
                    "id" => "email",
                    "name" => "email",
                    "required" => true,
                    "minlength" => 7,
                    "maxlength" => 250,
                    "error" => "Votre email est incorrect ou fait plus de 250 caractères"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "class" => "form-control",
                    "id" => "pwd",
                    "name" => "password",
                    "required" => true,
                    "minlength" => 6,
                    "error" => "Votre mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres"
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation",
                    "class" => "form-control",
                    "id" => "pwdConfirm",
                    "name" => "pwdConfirm",
                    "required" => true,
                    "confirm" => "password",
                    "error" => "Le mot de passe de confirmation ne correspond pas"
                ],
            ]
        ];
    }
}
