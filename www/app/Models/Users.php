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
        parent::__construct($id);
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
                $compare_groups = explode(",", $groups);
                $user_groups = explode(",", $this->__get('role'));

                if (array_intersect($compare_groups, $user_groups)) {
                        return true;
                    }
            }
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
            header('Location: ' . BASE_URL);
            exit;
        }
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
}
