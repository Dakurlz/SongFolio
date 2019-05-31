<?php
declare (strict_types = 1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;

class Users extends BaseSQL
{

    public function __construct($id = null)
    {
        if (!isset($id) && isset($_SESSION['user'])) {
            $id = $_SESSION['user'];
        }

        if (isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
            $token = htmlspecialchars($_COOKIE['token']);
            parent::__construct(['login_token' => $token]);
            $_SESSION['user'] = $this->__get('id');
        } else {
            parent::__construct($id);
        }
    }

    public function customSet($attr, $value)
    {
        switch ($attr) {
            case 'username':
                return ucfirst(strtolower(trim($value)));
                break;
            case 'email':
                return strtolower(trim($value));
                break;
            case 'password':
                return password_hash($value, PASSWORD_DEFAULT);
                break;
        }

        return $value;
    }

    public function is($groups)
    {
        if ($this->__get('id') > 0 && $_SESSION['user']) {
            if ($groups == 'connected') {
                return true;
            } else {
                $groups = explode(",", $groups);

                foreach ($groups as $group_name) {
                    $group = new Roles(['name' => $group_name]);
                    if ($group->id() == $this->__get('role_id')) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    // $user->can('permission') retourne true ou false selon si la permission est ou non dans le role de l'utilisateur
    public function can($askedAction)
    {
        $group = new Roles($this->__get('role_id'));
        if ($group->getPerm($askedAction) || $group->getPerm('all_perms')) {
            return true;
        }

        return false;
    }

    // hasPermission

    public static function hasPermission($askedAction): bool
    {
        $group = new Roles((new Users)->__get('role_id'));
        if ($group->getPerm($askedAction) || $group->getPerm('all_perms')) {
            return true;
        }

        return false;
    }

    //Static User::need('permission') permet de vérifier si la permission est ou non dans le role de l'utilisteur CONNECTE et le redirige si ce n'est pas le cas.
    public static function need($askedAction): void
    {
        $user = new Users();
        if (!$user->can($askedAction)) {
            header('Location: ' . BASE_URL);
        }
    }

    public function needAuth(): void
    {
        if (!$this->is('connected')) {
            header('Location: ' . Routing::getSlug('Users', 'login') . '?redirect=' . urlencode($_SERVER[REQUEST_URI]));
            exit;
        }
    }

    public function needGroups($groups): void
    {
        $this->needAuth();

        if (!$this->is($groups) && !$this->is('admin')) {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    /**
     * Send user full name
     *
     * @return string
     */
    public function getFullName(): string
    {
        $first = $this->__get('first_name');
        $last = $this->__get('last_name');
        return "$first $last";
    }
    
    /**
     * check if  first name existe send full name else username 
     *
     * @return string
     */
    public function getUserName(): string
    {
        return ($this->__get('first_name') === null || $this->__get('first_name') === '') ? $this->__get('username') : $this->getFullName();
    }

    public function getFormRegister()
    {
        return [
            "config" => [
                "action" => Routing::getSlug("Users", "register"),
                "method" => "POST",
                "class" => "",
                "id" => "",
                "reset" => "Annuler",
                "submit" => "S'enregistrer"
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Inscription",
                    "class" => "btn btn-success-outline"
                ],
            ],
            "data" => [
                "username" => [
                    "type" => "text",
                    "placeholder" => "Votre pseudo",
                    "class" => "form-control",
                    "id" => "username",
                    "name" => "username",
                    "required" => true,
                    "minlength" => 4,
                    "maxlength" => 50,
                    "error" => "Votre pseudo doit faire entre 4 et 50 caractères"
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

    public function getFormLogin()
    {
        return [
            "config" => [
                "action" => Routing::getSlug("Users", "login") . (isset($_GET['redirect']) ? '?redirect=' . htmlspecialchars($_GET['redirect']) : ''),
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
            ],
            "data" => [
                "username" => [
                    "type" => "text",
                    "placeholder" => "Votre pseudo",
                    "class" => "form-control",
                    "id" => "username",
                    "name" => "username",
                    "required" => true,
                    "minlength" => 4,
                    "maxlength" => 50,
                    "error" => "Votre pseudo doit faire entre 4 et 50 caractères"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "class" => "form-control",
                    "id" => "password",
                    "name" => "password",
                    "required" => true,
                    "minlength" => 6,
                    "error" => "Votre mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres"
                ]
            ]
        ];
    }

    public function getFormUsers()
    {
        return [
            'create' => [
                "config" => [
                    "action" => Routing::getSlug("Users", "createUsers"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Ajouter un nouveau utilisateur',
                    'action_type' => 'create'
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Ajouter",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                'data' => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    "username" => [
                        "type" => "text",
                        'label' => 'Username',
                        "placeholder" => "Votre pseudo",
                        "class" => "form-control col-12 col-lg-4 col-md-4 col-sm-4",
                        "id" => "username",
                        "name" => "username",
                        "required" => true,
                        "minlength" => 4,
                        "maxlength" => 50,
                        "error" => "Votre pseudo doit faire entre 4 et 50 caractères"
                    ],
                    'start_row_name' => [
                        'type' => 'start_row'
                    ],
                    'first_name' => [
                        "type" => "text",
                        "label" => "Prénom",
                        "class" => "input-control",
                        "id" => "first_name",
                        "name" => "first_name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 50,
                        "error" => "Votre prénom doit faire entre 2 et 50 caractères",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "options" => [],
                    ],
                    "last_name" => [
                        "type" => "text",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Nom",
                        "class" => "form-control",
                        "id" => "last_name",
                        "name" => "last_name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 250,
                        "error" => "Votre prénom doit faire entre 2 et 50 caractères"
                    ],
                    'end_row_name' => [
                        'type' => 'end_row'
                    ],
                    'start_row_info' => [
                        'type' => 'start_row'
                    ],
                    'role' => [
                        'type' => 'select',
                        "label" => "Role d'utilisateur",
                        "class" => "input-control",
                        "id" => "role",
                        "name" => "role",
                        "required" => true,
                        "error" => "Selectioner role",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "options" => [],
                    ],
                    "email" => [
                        "type" => "email",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Votre email",
                        "class" => "form-control",
                        "id" => "email",
                        "name" => "email",
                        "required" => true,
                        "minlength" => 7,
                        "maxlength" => 250,
                        "error" => "Votre email est incorrect ou fait plus de 250 caractères"
                    ],
                    'end_row_info' => [
                        'type' => 'end_row'
                    ],
                    'start_row_pass' => [
                        'type' => 'start_row'
                    ],
                    "password" => [
                        "type" => "password",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Votre mot de passe",
                        "class" => "form-control ",
                        "id" => "pwd",
                        "name" => "password",
                        "required" => true,
                        "minlength" => 6,
                        "error" => "Votre mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres"
                    ],
                    "pwdConfirm" => [
                        "type" => "password",
                        "class" => "form-control",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Confirmation",
                        "id" => "pwdConfirm",
                        "name" => "pwdConfirm",
                        "required" => true,
                        "confirm" => "password",
                        "error" => "Le mot de passe de confirmation ne correspond pas"
                    ],
                    'end_row_pass' => [
                        'type' => 'end_row'
                    ],
                ]
            ],
            'update' => [
                "config" => [
                    "action" => Routing::getSlug("Users", "updateUsers"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Modifié un utilisateur',
                    'action_type' => 'update'
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Modifié",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                'data' => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    "username" => [
                        "type" => "text",
                        'label' => 'Username',
                        "placeholder" => "Votre pseudo",
                        "class" => "form-control col-12 col-lg-4 col-md-4 col-sm-4",
                        "id" => "username",
                        "name" => "username",
                        "required" => true,
                        "minlength" => 4,
                        "maxlength" => 50,
                        "error" => "Votre pseudo doit faire entre 4 et 50 caractères"
                    ],
                    'start_row_name' => [
                        'type' => 'start_row'
                    ],
                    'first_name' => [
                        "type" => "text",
                        "label" => "Prénom",
                        "class" => "input-control",
                        "id" => "first_name",
                        "name" => "first_name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 50,
                        "error" => "Votre prénom doit faire entre 2 et 50 caractères",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "options" => [],
                    ],
                    "last_name" => [
                        "type" => "text",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Nom",
                        "class" => "form-control",
                        "id" => "last_name",
                        "name" => "last_name",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 250,
                        "error" => "Votre prénom doit faire entre 2 et 50 caractères"
                    ],
                    'end_row_name' => [
                        'type' => 'end_row'
                    ],
                    'start_row_info' => [
                        'type' => 'start_row'
                    ],
                    'role' => [
                        'type' => 'select',
                        "label" => "Role d'utilisateur",
                        "class" => "input-control",
                        "id" => "role",
                        "name" => "role",
                        "required" => true,
                        "error" => "Selectioner role",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "options" => [],
                    ],
                    "email" => [
                        "type" => "email",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Votre email",
                        "class" => "form-control",
                        "id" => "email",
                        "name" => "email",
                        "required" => true,
                        "minlength" => 7,
                        "maxlength" => 250,
                        "error" => "Votre email est incorrect ou fait plus de 250 caractères"
                    ],
                    'end_row_info' => [
                        'type' => 'end_row'
                    ],
                    'start_row_pass' => [
                        'type' => 'start_row'
                    ],
                    "password" => [
                        "type" => "password",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Votre mot de passe",
                        "class" => "form-control ",
                        "id" => "pwd",
                        "name" => "password",
                        "required" => true,
                        "minlength" => 6,
                        "error" => "Votre mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres"
                    ],
                    "pwdConfirm" => [
                        "type" => "password",
                        "class" => "form-control",
                        'div_class' => 'col-12 col-lg-4 col-md-6 col-sm-6',
                        "label" => "Confirmation",
                        "id" => "pwdConfirm",
                        "name" => "pwdConfirm",
                        "required" => true,
                        "confirm" => "password",
                        "error" => "Le mot de passe de confirmation ne correspond pas"
                    ],
                    'end_row_pass' => [
                        'type' => 'end_row'
                    ],

                ]
            ]
        ];
    }

    public function getFormModifyPwd()
    {
        return [
            "config"=>[
                "action"=>Routing::getSlug("Users", "dashboard"),
                "method"=>"POST",
                "class"=>"",
                "id"=>"",
                "submit"=>"Changer de mot de passe"
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Changer mon mot de passe",
                    "class" => "btn btn-success-outline"
                ],
            ],

            "data"=>[
                "old_pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Mot de passe actuel",
                    "class"=>"form-control",
                    "id"=>"old_pwd",
                    "name"=>"old_pwd",
                    "required"=>true,
                    "minlength"=>6,
                    "error"=>""
                ],
                "new_pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Nouveau mot de passe",
                    "class"=>"form-control",
                    "id"=>"new_pwd",
                    "name"=>"new_pwd",
                    "required"=>true,
                    "minlength"=>6,
                    "error"=>"Votre nouveau mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres",
                    "error_1"=>"Votre nouveau de passe n'est pas identique."
                ],
                "valid_new_pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmer mot de passe",
                    "class"=>"form-control",
                    "id"=>"valid_new_pwd",
                    "name"=>"valid_new_pwd",
                    "required"=>true,
                    "minlength"=>6,
                    "error"=>"La confirmation de votre mot de passe doit faire plus de 6 caractères avec des minuscules, majuscules et chiffres",
                    "error_not_same"=>"Le nouveau mot de passe saisit n'est pas identique."
                ],
            ]
        ];

    }
}
