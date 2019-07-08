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

    public function getPerm($value)
    {
        $perms = $this->__get('perms');
        return $perms[$value] ?? false;
    }

    public static function prepareRoleToSelect($roles): array
    {
        $arr = [];
        foreach ($roles as $role) {
            $arr[] = ['label' => $role['name'], 'value' => $role['id']];
        }
        return $arr;
    }

    public function permsList()
    {
        return [
            "all" => [
                "perms" => [
                    "all_perms" => [
                        "desc" => "Donner tous les droits (SuperAdmin)"
                    ]
                ]
            ],
            "basics" => [
                "title" => "Permissions générales",
                "perms" => [
                    "access_admin" => [
                        "desc" => "Acceder au panel admin"
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
                    "page_view" => [
                        "desc" => "Voir les pages"
                    ],
                    "article_view" => [
                        "desc" => "Voir les articles"
                    ],
                    "content_add" => [
                        'desc' => 'Ajouter un contenu'
                    ],
                    "content_edit" => [
                        'desc' => 'Modifier un contenu'
                    ],
                    "content_del" => [
                        'desc' => 'Supprimer un contenu'
                    ],
                    "content_pub" => [
                        "desc" => "Permission de publication"
                    ],
                ]
            ],
            'events' => [
                'title' => 'Gestion des événements',
                'perms' => [
                    "event_add" => [
                        'desc' => 'Ajouter un événement'
                    ],
                    "event_edit" => [
                        'desc' => 'Modifier un événement'
                    ],
                    "event_del" => [
                        'desc' => 'Supprimer un événement'
                    ]
                ]
            ],
            'comment' => [
                'title' => 'Gestion des commentaire',
                'perms' => [
                    "comment_perm" => [
                        'desc' => 'Accepter/Refuser des commentaires '
                    ],
                ]
            ],
            'category' => [
                "title" => "Gestion des categories",
                "perms" => [
                    "categorie_view" => [
                        "desc" => "Acceder aux catégories"
                    ],
                    "cat_album_add" => [
                        "desc" => "Ajouter une categorie d'album"
                    ],
                    "cat_album_edit" => [
                        "desc" => "Modifier une categorie d'album"
                    ],
                    "cat_album_del" => [
                        "desc" => "Supprimer une categorie d'album"
                    ],
                    "cat_article_add" => [
                        "desc" => "Ajouter une categorie d'article"
                    ],
                    "cat_article_edit" => [
                        "desc" => "Modifier une categorie d'article"
                    ],
                    "cat_article_del" => [
                        "desc" => "Supprimer une categorie d'article"
                    ],
                    "cat_event_add" => [
                        "desc" => "Ajouter une categorie d'événement"
                    ],
                    "cat_event_edit" => [
                        "desc" => "Modifier une categorie d'événement"
                    ],
                    "cat_event_del" => [
                        "desc" => "Supprimer une categorie d'événement"
                    ],
                ]
            ],
            "roles" => [
                "title" => "Gestion des roles",
                "perms" => [
                    "role_view" => [
                        "desc" => "Acceder aux rôle"
                    ],
                    "role_add" => [
                        "desc" => "Ajouter un rôle"
                    ],
                    "role_edit" => [
                        "desc" => "Modifier un rôle"
                    ],
                    "role_del" => [
                        "desc" => "Supprimer un rôle"
                    ]
                ]
            ],

            "albums" => [
                "title" => "Gestion des albums",
                "perms" => [
                    "album_view" => [
                        "desc" => "Voir les albums"
                    ],
                    "album_add" => [
                        "desc" => "Ajouter un album"
                    ],
                    "album_edit" => [
                        "desc" => "Modifier un album"
                    ],
                    "album_del" => [
                        "desc" => "Supprimer un album"
                    ]
                ]
            ],

            "menus" => [
                "title" => "Gestion des menus",
                "perms" => [
                    "menu_view" => [
                        "desc" => "Voir les menus"
                    ],
                    "menu_add" => [
                        "desc" => "Ajouter un menu"
                    ],
                    "menu_edit" => [
                        "desc" => "Modifier un menu"
                    ],
                    "menu_del" => [
                        "desc" => "Supprimer un menu"
                    ]
                ]
            ]
        ];
    }
}
