<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Models\Songs;
use Songfolio\Core\View;
use Songfolio\Models\Albums;
use Songfolio\Models\Users;
use Songfolio\Core\Validator;
use Songfolio\Core\Helper;
use Songfolio\Core\Routing;

class SongsController
{
    private $song;
    private $album;

    public function __construct(Songs $song, Albums $album)
    {
        $this->song = $song;
        $this->album = $album;
    }

    public function createAction()
    {
        Users::need('song_add');

        $configForm = $this->song->getFormSongs()['create'];
        $albums = $this->album->getAllData();
        $configForm['data']['album']['options'] = Albums::prepareAlbumToSelect($albums);
        self::push($configForm, 'create');
        self::renderSongsView($configForm);
    }

    public function deleteAction()
    {
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $this->song->delete(["id" => $id]);
            $_SESSION['alert']['info'][] = 'Morceau supprimé';
        } else {
            $_SESSION['alert']['danger'][] = 'Une erreur se produit ...';
        };

        header('Location: ' . Routing::getSlug('Songs', 'listSongs'));
    }

    public function updateAction()
    {
        Users::need('song_edit');
        $id = $_REQUEST['id'] ?? '';
        $configForm = $this->song->getFormSongs()['update'];
        $configForm['values'] = (array) $this->song->getOneBy(['id' => $id]);
        $albums = $this->album->getAllData();
        if ($configForm['values']['album_id'] !== null) $configForm['data']['type']['selected'] = 'yes';
        $configForm['data']['album']['options'] = Albums::prepareAlbumToSelect($albums);
        self::renderSongsView($configForm);
    }

    public function updateSongAction()
    {
        $configForm = $this->song->getFormSongs()['update'];
        self::push($configForm);
        header('Location: ' . Routing::getSlug('Songs', 'listSongs'));
    }

    public function listSongsAction()
    {
        $songs = $this->song->getAllData();
        $album = $this->album->getAllData();
        $view = new View('admin/songs/list', 'back');
        $view->assign('listSongs', $songs);
        $view->assign('albums', $album);
    }

    private function renderSongsView($configForm): void
    {
        $view = new View('admin/songs/create', 'back');
        $view->assign('configFormSongs', $configForm);
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
            $fileName = Helper::uploadImage('public/uploads/songs/', 'img_dir');


            if (empty($errors)) {
                isset($_REQUEST['id']) ? $this->song->__set('id', $_REQUEST['id']) : null;

                $this->song->__set('name', $data['name']);
                $this->song->__set('slug',  $data['slug']);
                $this->song->__set('description',  trim($data['description']));
                $this->song->__set('text',  trim($data['text']));
                isset($data['album']) ? $this->song->__set('album_id', (int) $data['album']) : null;
                isset($fileName) ? $this->song->__set('cover_dir', $fileName) : null;

                isset($data['spotify']) ? $this->song->__set('spotify',  $data['spotify']) : null;
                isset($data['deezer']) ?  $this->song->__set('deezer',  $data['deezer']) : null;
                isset($data['youtube']) ?  $this->song->__set('youtube',  $data['youtube']) : null;

                $this->song->save();



                if ($configForm['config']['action_type'] === 'create') {
                    $_SESSION['alert']['success'][] = 'Morceau ajouté';
                }
                $_SESSION['alert']['info'][] = 'Morceau modifé';

            } else {
                if (empty($errors)) {
                    $_SESSION['alert']['danger'][] =  'Album existe déjà';
                }
                $_SESSION['alert']['danger'] = $errors;
            }
        }
        return false;
    }
}
