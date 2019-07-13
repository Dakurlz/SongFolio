<?php
declare (strict_types = 1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Core\Helper;

class Users extends BaseSQL
{

    public function __construct($id = null)
    {
        if($id == 'empty') {
            parent::__construct();
        }else{
            if (!$id && isset($_SESSION['user'])) {
                $id = $_SESSION['user'];
            }

            if (!$id && isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
                $token = htmlspecialchars($_COOKIE['token']);
                parent::__construct(['login_token' => $token]);
                $_SESSION['user'] = $this->__get('id');
            } else {
                parent::__construct($id);
            }
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
    public function can(string $askedAction)
    {
        $group = new Roles($this->__get('role_id'));
        if ($group->getPerm($askedAction) || $group->getPerm('all_perms')) {
            return true;
        }

        return false;
    }

    //Static User::need('permission') permet de vérifier si la permission est ou non dans le role de l'utilisteur CONNECTE et le redirige si ce n'est pas le cas.
    public static function need(string $askedAction): void
    {
        $user = new Users();
        if (!$user->can($askedAction)) {
            header('Location: ' . Helper::host());
        }
    }

    public function setLoginToken(){
        $token = md5(substr(uniqid().time(), 4, 10));
        setcookie('token', $token, time() + (86400 * 7), "/");
        $this->__set('login_token', $token);
        $this->save();
    }

    public function oAuthLogin($provider, $user_infos){
        if (!$this->getOneBy(['id_'.$provider => $user_infos['id']], true)) {
            if($this->getOneBy(['email' => $user_infos['email']], true)) {
                $_SESSION['alert']['danger'][] = 'Le mail associé à votre compte ' . $provider . ' est déjà dans notre base de donnée';
                $this->__set('id_'.$provider, $user_infos['id']);
            }else{
                $this->__set('email', $user_infos['email']);
                $this->__set('first_name', $user_infos['first_name']);
                $this->__set('last_name', $user_infos['last_name']);
                $this->__set('id_'.$provider, $user_infos['id']);
            }
        }
        $this->setLoginToken();
        header('Location: ' . Routing::getSlug("users", "dashboard"));
    }

    public static function hasPermission($askedAction): bool
    {
        $group = new Roles((new Users)->__get('role_id'));
        if ($group->getPerm($askedAction) || $group->getPerm('all_perms')) {
            return true;
        }

        return false;
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
            header('Location: ' . Helper::host());
            exit;
        }
    }

    /**
     * Send user full name
     *
     * @return string
     */
    public function getShowName(): string
    {
        $first = $this->__get('first_name');
        $last = substr($this->__get('last_name'), 0, 1);
        return "$first $last.";
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
                "first_name" => [
                    "type" => "text",
                    "placeholder" => "Nom",
                    "class" => "form-control",
                    "id" => "first_name",
                    "name" => "first_name",
                    "required" => true,
                    "minlength" => 3,
                    "maxlength" => 50,
                    "error" => "Votre prénom doit faire entre 3 et 50 caractères"
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
                    "error" => "Votre nom doit faire entre 3 et 100 caractères"
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
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "class" => "form-control",
                    "id" => "email",
                    "name" => "email",
                    "required" => true,
                    "label" => "Adresse mail",
                    "minlength" => 7,
                    "maxlength" => 250,
                    "error" => "Votre email doit faire entre 7 et 250 caractères"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "class" => "form-control",
                    "id" => "password",
                    "name" => "password",
                    "label" => "Mot de passe",
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
                    "action" => Routing::getSlug("Users", "update"),
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
                        "div_class" => "smart-type type-page"
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

    public function forgetPassword() {
        return [
            "config"=>[
                "action"=>Routing::getSlug("Users", "forgetPassword"),
                "method"=>"POST",
                "class"=>"",
                "id"=>"",
                "submit"=>"Envoyer un nouveau mot de passe"
            ],
            "btn" => [
                "submit" => [
                    "type" => "submit",
                    "text" => "Envoyer un nouveau mot de passe",
                    "class" => "btn btn-success-outline"
                ],
            ],
            "data"=>[
                "user_email"=>[
                    "type"=>"email",
                    "placeholder"=>"Adresse email",
                    "class"=>"form-control",
                    "id"=>"user_email",
                    "name"=>"user_email",
                    "required"=>true,
                    "error"=>"",
                ],
                ]
            ];
    }

    public function getFormNewPwd(){
        return [
            "config"=>[
                "action"=>Routing::getSlug("Users", "changePasswordAction"),
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
