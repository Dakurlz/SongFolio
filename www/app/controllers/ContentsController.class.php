<?php
declare (strict_types = 1);

namespace app\Controllers;

use app\core\View;
use app\Core\Validator;
use app\core\Helper;
use app\Models\Contents;

class ContentsController
{

    public function createContentsAction(): void
    {
        $content = new Contents();
        $configForm = $content->getFormContents();
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($data)) {
            // $validator = new Validator($configForm, $data);


            $fileName = Helper::uploadImage('public/uploads/contents/');

            $content->__set('type', $data['type']);
            $content->__set('slug', '/' . $data['slug']);
            $content->__set('title', $data['title']);
            $content->__set('description', $data['description']);
            $content->__set('content', $data['content']);
            $content->__set('header', " "); // ?????????
            $content->__set('author', 1); // ?????????
            $content->__set('img_dir', $fileName);
            $content->save();
        }

        $view = new View("admin/create_pages", "back");
        $view->assign('configFormPage', $configForm);
    }

    public function listesPagesAction(): void
    {
        $content = new Contents();

        $pageListes = $content->getOneBy(['type' => 'page']);

        $view = new View('admin/pages_lists', 'back');
        $view->assign('pageListes', $pageListes);
    }
}
