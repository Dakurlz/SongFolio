<?php

namespace Songfolio\Controllers;

use Songfolio\Core\Validator;
use Songfolio\Core\Helper;
use Songfolio\Models\Users;
use Songfolio\Core\View;
use Songfolio\Core\Alert;
use Songfolio\Models\Albums;
use Songfolio\Models\Categories;
use Songfolio\Models\Slug;
use Songfolio\Core\Routing;

class AlbumsController
{
    private $album;
    private $category;

    public function __construct(Albums $album, Categories $category)
    {
        $this->album = $album;
        $this->category = $category;

        Users::need('album_perm');
    }

    public function createAlbumAction()
    {
        Users::need('album_add');

        $configForm = $this->album->getFormAlbum()['create'];
        $categories = $this->category->getAllBy(['type' => 'album']);
        $configForm['data']['category']['options'] = Categories::prepareCategoriesToSelect($categories);
        self::push($configForm);
        self::renderAlbumsView($configForm);
    }

    public function updateAction()
    {
        Users::need('album_edit');
        $id = $_REQUEST['id'] ?? '';
        $configForm = $this->album->getFormAlbum()['update'];
        $configForm['values'] = (array) $this->album->getOneBy(['id' => $id]);
        $categories = $this->category->getAllBy(['type' => 'album']);
        $configForm['data']['category']['options'] = Categories::prepareCategoriesToSelect($categories);
        self::renderAlbumsView($configForm);
    }

    public function updateAlbumAction()
    {
        $configForm = $this->album->getFormAlbum()['update'];
        self::push($configForm);
        header('Location: ' . Routing::getSlug('Albums', 'listAlbums'));
    }

    public function deleteAction()
    {

        $id = $_REQUEST['id'];
        if (isset($id)) {
            $this->album->delete(["id" => $id]);
            $_SESSION['alert']['info'][] = 'Album supprimé';
        } else {
            $_SESSION['alert']['danger'][] = 'Une erreur se produit ...';
        };

        header('Location: ' . Routing::getSlug('Albums', 'listAlbums'));
    }

    public function listAlbumsAction()
    {
        $view  = new View('admin/albums/list', 'back');
        $view->assign('listAlbums', $this->album->getAllData());
        $view->assign('categories', $this->category->getAllBy(['type' => 'album']));
    }


    private function renderAlbumsView(array $configForm): void
    {
        $view = new View('admin/albums/create', 'back');
        $view->assign('configFormAlbum', $configForm);
    }



    private function push(array $configForm)
    {
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];
        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }
            $validator = new Validator($configForm, $data);
            $errors = $validator->getErrors();
            $fileName = Helper::uploadImage('public/uploads/albums/', 'cover_dir');


            if (empty($errors)) {
                isset($_REQUEST['id']) ? $this->album->__set('id', $_REQUEST['id']) : null;

                $this->album->__set('title', $data['title']);
                $this->album->__set('slug',  $data['slug']);
                $this->album->__set('description',  trim($data['description']));
                isset($data['category_id']) ? $this->album->__set('category_id', (int) $data['category_id']) : null;
                isset($fileName) ? $this->album->__set('cover_dir', $fileName) : null;

                isset($data['spotify']) ? $this->album->__set('spotify',  $data['spotify']) : null;
                isset($data['deezer']) ?  $this->album->__set('deezer',  $data['deezer']) : null;

                $this->album->save();

               
                if ($configForm['config']['action_type'] === 'create') {
                    $_SESSION['alert']['success'][] = 'Album créé';
                }
                $_SESSION['alert']['info'][] = 'Album modifé';

            } else {
                if (empty($errors)) {
                    $_SESSION['alert']['danger'][] = 'Album existe déjà';
                }
                $_SESSION['alert']['danger'] = $errors;
            }
        }
        return false;
    }
}
