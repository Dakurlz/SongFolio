<?php

namespace Songfolio\Controllers;

use Songfolio\Core\Validator;
use Songfolio\Core\Helper;
use Songfolio\Models\Users;
use Songfolio\Core\View;
use Songfolio\Core\Alert;
use Songfolio\Models\Albums;
use Songfolio\Models\Categories;

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
        $alert = self::push($configForm, 'create');
        $configForm['data']['category']['options'] = Categories::prepareCategoriesToSelect($categories);
        self::push($configForm, 'create');
        self::renderAlbumsView($configForm);

    }

    public function updateAction()
    {
        Users::need('album_edit');
        $id = $_REQUEST['id'] ?? '';

    }

    public function listAlbumsAction()
    {
        $view  = new View('admin/albums/list','back');
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

            if (empty($errors) && (!$this->album->getOneBy(['slug' => $data['slug']]) || isset($_REQUEST['id']))) {
                isset($_REQUEST['id']) ? $this->contents->__set('id', $_REQUEST['id']) : null;
                $fileName = Helper::uploadImage('public/uploads/albums/', 'cover_dir');

                $this->album->__set('title', $data['title']);
                $this->album->__set('slug',  $data['slug']);
                $this->album->__set('description',  trim($data['description']));
                isset($data['category_id']) ? $this->album->__set('category_id', (int)$data['category_id']) : null;
                isset($fileName) ? $this->album->__set('cover_dir', $fileName) : null;

                isset($data['spotify']) ? $this->album->__set('spotify',  $data['spotify']) : null;
                isset($data['deezer']) ?  $this->album->__set('deezer',  $data['deezer']) : null;

                $this->album->save();


                return Alert::setAlertPropsByAction($action, 'Album', false);
            } else {
                if (empty($errors)) {
                    return Alert::setAlertError('Album existe déjà');
                }
                return Alert::setAlertErrors($errors);
            }
        }
        return false; 
     }
}
