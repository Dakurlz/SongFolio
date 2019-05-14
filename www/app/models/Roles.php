<?php
declare (strict_types = 1);

namespace Songfolio\Models;
use Songfolio\Core\BaseSQL;


class Roles extends BaseSQL
{
    public function customSet($attr, $value)
    {
        switch ($attr) {
            case 'perms':
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
            case 'perms':
                return json_decode($value, true);
                break;
        }

        return $value;
    }

    public function getPerm($value){
        $perms = $this->__get('perms');
        return $perms[$value] ?? false;
    }

    public function permsList(){
        return [
            "all" => [
                "perms" => [
                    "all_perms" => [
                        "desc" => "Donner tous les droits (SuperAdmin)"
                    ]
                ]
            ],
            "users" => [
                "title" => "Gestion des utilisateurs",
                "perms" => [
                    "user_add" => [
                        "desc" => "Ajouter un utilisateur"
                    ],
                    "user_del" => [
                        "desc" => "Supprimer un utilisateur"
                    ],
                    "user_edit" => [
                        "desc" => "Modifier un utilisateur"
                    ]
                ]
            ],
            "roles" => [
                "title" => "Gestion des roles",
                "perms" => [
                    "role_view" => [
                        "desc" => "Voir les rôle"
                    ],
                    "role_add" => [
                        "desc" => "Ajouter un rôle"
                    ],
                    "role_del" => [
                        "desc" => "Supprimer un rôle"
                    ],
                    "role_edit" => [
                        "desc" => "Modifier un rôle"
                    ]
                ]
            ]
        ];
    }
}