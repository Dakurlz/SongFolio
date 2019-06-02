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

    public static function prepareRoleToSelect($roles): array
    {
        $arr = [];
        foreach ($roles as $role){
            $arr[] = ['label' => $role['name'], 'value' => $role['id']];
        }
        return $arr;
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
            'contents' => [
                'title' => 'Gestion des contenus (pages et articles)',
                'perms' => [
                    "content_add" => [
                        'desc' => 'Ajouter un contenu'
                    ],
                    "content_del" => [
                        'desc' => 'Supprimer un contenu'
                    ],
                    "content_edit" => [
                        'desc' => 'Modifier un contenu'
                    ],
                    "page_view" => [
                        "desc" => "Voir les pages"
                    ],
                    "article_view" => [
                        "desc" => "Voir les articles"
                    ],
                ]
            ],
            'events' => [
                'title' => 'Gestion des événements',
                'perms' => [
                    "event_add" => [
                        'desc' => 'Ajouter un événement'
                    ],
                    "event_del" => [
                        'desc' => 'Supprimer un événement'
                    ],
                    "event_edit" => [
                        'desc' => 'Modifier un événement'
                    ]
                ]
            ],
            'comment' => [
                'title' => 'Gestion des commentaire',
                'perms' => [
                    "comment_perm" => [
                        'desc' => 'Confirmation et rétraction des commentaires '
                    ],
                ]
            ],
            'category' => [
                "title" => "Gestion des categories",
                "perms" => [
                    "album_add" => [
                        "desc" => "Ajouter une categorie d'albmum"
                    ],
                    "article_add" => [
                        "desc" => "Ajouter une categorie d'article"
                    ],
                    "event_add" => [
                        "desc" => "Ajouter une categorie d'événement"
                    ],
                    "album_edit" => [
                        "desc" => "Modifier une categorie d'albmum"
                    ],
                    "article_edit" => [
                        "desc" => "Modifier une categorie d'article"
                    ],
                    "event_edit" => [
                        "desc" => "Modifier une categorie d'événement"
                    ],
                    "album_del" => [
                        "desc" => "Supprimer une categorie d'albmum"
                    ],
                    "article_del" => [
                        "desc" => "Supprimer une categorie d'article"
                    ],
                    "event_del" => [
                        "desc" => "Supprimer une categorie d'événement"
                    ],
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