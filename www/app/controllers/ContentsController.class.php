<?php
declare (strict_types = 1);

namespace app\Controllers;

use app\core\View;
use app\Core\Validator;
use app\core\Helper;
use app\Models\Contents;

class ContentsController
{

    private $contents;

    public function __construct(Contents $contents)
    {
        $this->contents = $contents;
    }

    public function createContentsAction(): void
    {
        $configForm = $this->contents->getFormContents();
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($data)) {
            // $validator = new Validator($configForm, $data);
            debug($data['published']);

            $fileName = Helper::uploadImage('public/uploads/contents/');

            $this->contents->__set('type', $data['type']);
            $this->contents->__set('slug', '/' . $data['slug']);
            $this->contents->__set('title', $data['title']);
            $this->contents->__set('description', $data['description']);
            $this->contents->__set('content', $data['content']);
            $this->contents->__set('header', " "); // ?????????
            $this->contents->__set('author', 1); // ?????????
            $this->contents->__set('img_dir', $fileName);
            // $this->contents->__set('published', $data['published']);
            $this->contents->save();
        }

        $view = new View("admin/create_pages", "back");
        $view->assign('configFormPage', $configForm);
    }

    public function listesPagesAction(): void
    {
        $pageListes = $this->contents->getAllBy(['type' => 'page']);
        $view = new View('admin/pages_lists', 'back');
        $view->assign('pages', $pageListes);
    }

    public function listesArticlesAction(): void
    {
        $pageListes = $this->contents->getAllBy(['type' => 'article']);
        $view = new View('admin/pages_lists', 'back');
        $view->assign('articles', $pageListes);
    }
}
