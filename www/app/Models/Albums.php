<?php

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Core\View;
use Songfolio\Models\Likes;

class Albums extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function show()
    {

        $user = new Users();

        $songs = (new Songs)->getAllBy(['album_id' => $this->__get('id')]);
        $likesSongs = (new Likes())->getAllBy(['type' => 'songs']);
        $likesAlbum = (new Likes())->getAllBy(['type' => 'albums', 'type_id'=> $this->__get('id')]);

        foreach ($songs as $key => $song) {
            $songs[$key]['nbLikesSongs'] = Likes::displayLike($likesSongs, $song['id']);
            $songs[$key]['checkUserLike'] = Likes::checkIfUserLiked($likesSongs, $song['id'], $user->__get('id'));
        }

        $prepare = array_column($songs, 'nbLikesSongs');
        array_multisort($prepare, SORT_DESC, $songs);

        $checkUserLike = Likes::checkIfUserLiked($likesAlbum, $this->__get('id'), $user->__get('id'));

        $view = new View("albums/album", "front");

        if ($this->__get('category_id') != null) {
            $category_name = (new Categories($this->__get('category_id')))->__get('name');
            $view->assign('category_name', $category_name);
        }

        if ($this->__get('comment_active') === '1') {
            $comments = (new Comments)->prepareComments('albums', $this->__get('id'));
            $view->assign('comments', $comments);
        }



        $view->assign('album', $this);
        $view->assign('songs', $songs);
        $view->assign('nb_like', count($likesAlbum));
        $view->assign('checkUserLike', $checkUserLike);
    }


    /**
     * @param array $categories
     * @return array
     */
    public static function prepareAlbumToSelect(array $albums): array
    {
        $arr = [];
        foreach ($albums as $album) {
            $arr[] = ['label' => $album['title'], 'value' => $album['id']];
        }

        return $arr;
    }

    public function getFormAlbum()
    {
        return [
            "create" => [
                "config" => [
                    "action" => Routing::getSlug("Albums", "createAlbum"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Ajouter un nouvel album',
                    'action_type' => 'create',
                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Ajouter",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                "data" => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    "title" => [
                        "type" => "text",
                        "name" => "title",
                        "label" => "Nom de l'albmu",
                        "class" => "input-control target-elment-to-slug",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 1,
                        "maxlength" => 50,
                        "error" => "Votre catégorie doit faire entre 1 et 60 caractères"
                    ],

                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category_id",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],

                    'cover_dir' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
                        "name" => "cover_dir",
                        "label" => "Image de banière",
                        "class" => ""
                    ],

                    "separator1" => [
                        "type" => "separator",
                        "after_title" => "Médias"
                    ],
                    'deezer' => [
                        'type' => 'text',
                        'name' => 'deezer',
                        'label' => 'Lien deezer',
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'spotify' => [
                        'type' => 'text',
                        'name' => 'spotify',
                        'label' => 'Lien spotify',
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'comment_active' => [
                        'type' => 'checkbox',
                        'id' => 'comment_active',
                        "name" => "comment_active",
                        'label' => 'Autoriser les commentaires',
                        "div_class" => "smart-type type-article",
                        "required" => false,
                    ],
                    "separator2" => [
                        "type" => "separator",
                        "after_title" => "SEO"
                    ],
                    "slug" => [
                        "type" => "slug",
                        "label" => "Lien permanent",
                        "class" => "title-value-slug",
                        "presed" => $_SERVER['SERVER_NAME'],
                        "id" => "slug",
                        "name" => "slug",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 1,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 1 et 100 caractères"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "label" => "Description",
                        "id" => "description",
                        "name" => "description",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
                    ],


                ]
            ],
            'update' => [
                "config" => [
                    "action" => Routing::getSlug("Albums", "updateAlbum"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Modifé un nouvel album',
                    'action_type' => 'update',
                    'current_object' => $this

                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Modifé",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                "data" => [
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => ""
                    ],
                    "title" => [
                        "type" => "text",
                        "name" => "title",
                        "label" => "Nom de l'albmu",
                        "class" => "input-control target-elment-to-slug",
                        "id" => "name",
                        "required" => true,
                        "minlength" => 1,
                        "maxlength" => 50,
                        "error" => "Votre titre doit faire entre 1 et 60 caractères"
                    ],

                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category_id",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],

                    'cover_dir' => [
                        "type" => "file",
                        "div_class" => "",
                        "id" => "fileToUpload",
                        "name" => "cover_dir",
                        "label" => "Image de banière",
                        "class" => ""
                    ],

                    "separator1" => [
                        "type" => "separator",
                        "after_title" => "Médias"
                    ],
                    'deezer' => [
                        'type' => 'text',
                        'name' => 'deezer',
                        'label' => 'Lien deezer',
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'spotify' => [
                        'type' => 'text',
                        'name' => 'spotify',
                        'label' => 'Lien spotify',
                        'class' => 'form-control  col-lg-3 col-md-4 col-sm-4 col-12',
                    ],
                    'comment_active' => [
                        'type' => 'checkbox',
                        'id' => 'comment_active',
                        "name" => "comment_active",
                        'label' => 'Autoriser les commentaires',
                        "div_class" => "smart-type type-article",
                        "required" => false,
                    ],

                    "separator2" => [
                        "type" => "separator",
                        "after_title" => "SEO"
                    ],
                    "slug" => [
                        "type" => "slug",
                        "label" => "Lien permanent",
                        "class" => "title-value-slug",
                        "presed" => $_SERVER['SERVER_NAME'],
                        "id" => "slug",
                        "name" => "slug",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 1,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 1 et 100 caractères"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "label" => "Description",
                        "id" => "description",
                        "name" => "description",
                        "placeholder" => "",
                        "required" => true,
                        "error" => ""
                    ],


                ]
            ]
        ];
    }
}
