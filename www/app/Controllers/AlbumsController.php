<?php

namespace Songfolio\Controllers;

use Songfolio\Models\Users;
use Songfolio\Core\View;
use Songfolio\Models\Albums;

class AlbumsController
{
    private $album;

    public function __construct(Albums $album)
    {
        $this->album = $album;

        Users::need('album_perm');
    }

    public function createAlbumAction()
    {
        Users::need('album_add');

        $configForm = $this->album->getFormAlbum()['create'];
        // self::push($configForm, 'create');
        self::renderAlbumsView($configForm);

    }


    private function renderAlbumsView(array $configForm): void
    {
        $view = new View('admin/albums/create', 'back');
        $view->assign('configFormAlbum', $configForm);
     }
}
