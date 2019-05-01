<?php

return [
    'mapping_header_name' => [
        'admin' => 'Admin',
        'categories' => 'Categories',
        'dashboard' => 'Tableau de board',
        'albums' => 'Albumes',
        'comments' => 'Commentaires',
        'users' => 'Utilisateurs',
        'contents' => 'Contenus'
    ],
    'sidebar_items' => [
        'dashboard' => [
            'slug' => [
                'controller' => 'Admin',
                'action' => 'default'
            ],
            'name' => 'Tableau de board'
        ],

        'contents' => [
            'slug' => [
                'controller' => 'Admin',
                'action' => 'loadUser'
            ],
            'name' => 'Contenus',

        ],

        'users' => [
            'slug' => [
                'controller' => 'Admin',
                'action' => 'loadUser'
            ],
            'name' => 'Utilisateurs'
        ],

        'comments' => [
            'slug' => [
                'controller' => 'Comments',
                'action' => 'TO DO'
            ],
            'name' => 'Commentaires'
        ],

        'categories' => [
            'slug' => [
                'controller' => 'Categories',
                'action' => 'index'
            ],
            'name' => 'Categories',
            'dropdown' => [
                'slugs' => [
                    'album' => [
                        'controller' => 'Categories',
                        'action' => 'album',
                        'label' => 'Albume'
                    ],
                    'article' => [
                        'controller' => 'Categories',
                        'action' => 'article',
                        'label' => 'Article'
                    ]
                ]
            ]
        ]
    ]
];
