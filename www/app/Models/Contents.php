<?php

namespace Songfolio\Models;
use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Core\View;
use Songfolio\Models\Comments;

class Contents extends BaseSQL
{
    private $comment;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->comment = new Comments();
    }

    public function customSet($attr, $value)
    {
        return trim($value);
    }

    public static function getBySlug($slug)
    {
        $content = new Contents();
        $content->getOneBy(['slug' => $slug, 'published' => 1 ], true);

        if ($content->__get('id')) {
            return $content;
        }

        return false;
    }

    public function show()
    {
        $view = new View("content", "front");
        if($this->__get('comment_active') === '1'){
            $comments = $this->comment->prepareComments('article',$this->__get('id'));
            $view->assign('comments',$comments);
        }

        $view->assign('page_title', $this->__get('title'));
        $view->assign('page_desc', $this->__get('description '));
        $view->assign('content', $this);
        // $view->
    }

    public function content()
    {
        return $this->__get('content');
    }

    public function is(string $type)
    {
        if($this->__get('type')===$type) return true;
        return false;
    }

    public function getFormContents(): array
    {
        return [
            'create' => [
                "config" => [
                    "action" => Routing::getSlug("Contents", "createContents"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Ajouter un nouveau  contenu',
                    'action_type' => 'create'
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
                    "type" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Type",
                        "id" => "type",
                        "name" => "type",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner type",
                        "options" => [
                            ["label" => "Page", "value" => "page"],
                            ["label" => "Article", "value" => "article"],
                        ],
                    ],
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => "Paramètres de la page"
                    ],
                    "separator-article" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-article",
                        "after_title" => "Paramètres de l'article"
                    ],
                    "title" => [
                        "type" => "text",
                        "label" => "Titre",
                        "placeholder" => "Votre titre",
                        "class" => "input-control col-12 col-lg-4 col-md-4 col-sm-4",
                        "id" => "title",
                        "name" => "title",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 200,
                        "error" => "Votre titre doit faire entre 2 et 200 caractères"
                    ],
                    "category" => [
                        "type" => "select",
                        "class" => "col-12 col-lg-4 col-md-4 col-sm-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category",
                        "placeholder" => "",
                        "required" => false,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],
                    "content" => [
                        "type" => "textarea",
                        "label" => "Contenu",
                        "class" => "textare-control editor",
                        "id" => "content",
                        "name" => "content",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 2000,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
                    ],
                    "img-page" => [
                        "type" => "file",
                        "div_class" => "smart-type type-page",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image de banière (Taille conseillée : 1920x380px)",
                        "class" => ""
                    ],
                    "img-article" => [
                        "type" => "file",
                        "div_class" => "smart-type type-article",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image d'article",
                        "class" => ""
                    ],
                    'comment_active' => [
                        'type' => 'checkbox',
                        'id' => 'comment_active',
                        "name" => "comment_active",
                        'label' => 'Autoriser les commentaires',
                        "div_class" => "smart-type type-article",
                        "required" => false,
                    ],
                    'published' => [
                        'type' => 'checkbox',
                        'id' => 'published',
                        "name" => "published",
                        'label' => 'Publié',
                        "required" => false,
                    ],
                    "separator2" => [
                        "type" => "separator",
                        "after_title" => "SEO"
                    ],
                    "slug" => [
                        "type" => "slug",
                        "label" => "Lien permanent",
                        "class" => "",
                        "presed" => $_SERVER['SERVER_NAME'],
                        "id" => "slug",
                        "name" => "slug",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
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
                    'indexed' => [
                        'type' => 'checkbox',
                        'id' => 'indexed',
                        "name" => "indexed",
                        'label' => 'Indexé par les moteurs de recherche',
                        "required" => false,
                    ]
                ]
            ],
            'update' => [
                "config" => [
                    "action" => Routing::getSlug("Contents", "updateContent"),
                    "method" => "POST",
                    "class" => "",
                    'header' => 'Modification du contenu',
                    'action_type' => 'update'

                ],
                "btn" => [
                    "submit" => [
                        "type" => "submit",
                        "text" => "Modifier",
                        "class" => "btn btn-success-outline"
                    ],
                ],
                "data" => [
                    "type" => [
                        "type" => "select",
                        "class" => "col-4 smart-toggle",
                        "label" => "Type",
                        "id" => "type",
                        "name" => "type",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Selectioner type",
                        "options" => [
                            ["label" => "Page", "value" => "page"],
                            ["label" => "Article", "value" => "article"],
                        ],
                    ],
                    "separator-page" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-page",
                        "after_title" => "Paramètres de la page"
                    ],
                    "separator-article" => [
                        "type" => "separator",
                        "div_class" => "smart-type type-article",
                        "after_title" => "Paramètres de l'article"
                    ],
                    "title" => [
                        "type" => "text",
                        "label" => "Titre",
                        "placeholder" => "Votre titre",
                        "class" => "input-control col-4",
                        "id" => "title",
                        "name" => "title",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 200,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
                    ],
                    "category" => [
                        "type" => "select",
                        "class" => "col-4 smart-toggle",
                        "label" => "Categorie",
                        "div_class" => "smart-type type-article",
                        "id" => "category",
                        "name" => "category",
                        "placeholder" => "",
                        "required" => false,
                        "error" => "Selectioner le categorie",
                        "options" => [],
                    ],
                    "content" => [
                        "type" => "textarea",
                        "label" => "Contenu",
                        "class" => "textare-control editor",
                        "id" => "content",
                        "name" => "content",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 2000,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
                    ],
                    "img-page" => [
                        "type" => "file",
                        "div_class" => "smart-type type-page",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image de banière",
                        "class" => ""
                    ],
                    "img-article" => [
                        "type" => "file",
                        "div_class" => "smart-type type-article",
                        "id" => "fileToUpload",
                        "required" => false,
                        "name" => "img_dir",
                        "label" => "Image d'article",
                        "class" => ""
                    ],
                    'comment_active' => [
                        'type' => 'checkbox',
                        'id' => 'comment_active',
                        "name" => "comment_active",
                        'label' => 'Autoriser les commentaires',
                        "div_class" => "smart-type type-article",
                        "required" => false,
                    ],
                    'published' => [
                        'type' => 'checkbox',
                        'id' => 'published',
                        "name" => "published",
                        'label' => 'Publié',
                        "required" => false,
                    ],
                    "separator2" => [
                        "type" => "separator",
                        "after_title" => "SEO"
                    ],
                    "slug" => [
                        "type" => "slug",
                        "label" => "Lien permanent",
                        "class" => "",
                        "presed" => $_SERVER['SERVER_NAME'],
                        "id" => "slug",
                        "name" => "slug",
                        "placeholder" => "",
                        "required" => true,
                        "minlength" => 2,
                        "maxlength" => 100,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "label" => "Description",
                        "id" => "description",
                        "name" => "description",
                        "placeholder" => "",
                        "required" => true,
                        "error" => "Votre titre doit faire entre 2 et 100 caractères"
                    ],
                    'indexed' => [
                        'type' => 'checkbox',
                        'id' => 'indexed',
                        "name" => "indexed",
                        'label' => 'Indexé par les moteurs de recherche',
                        "required" => false,
                    ]
                ]
            ]
        ];
    }
}
