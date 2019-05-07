<?php
declare (strict_types = 1);

namespace Songfolio\Controllers;

use Songfolio\core\View;
use Songfolio\Core\Validator;
use Songfolio\core\Helper;
use Songfolio\Models\Contents;

class ContentsController
{

    private $contents;

    public function __construct(Contents $contents)
    {
        $this->contents = $contents;
    }

    public function createContentsAction(): void
    {
        $configForm = $this->contents->getFormContents()['create'];
        $alert = self::push($configForm, 'create');
        self::renderContentsView($alert, $configForm);
    }

    public function deleteAction()
    {
        $id = $_REQUEST['id'];

        if (isset($id)) {
            $this->contents->delete(["id" => $id]);
            $alert = Helper::getAlertPropsByAction('delete', 'Contenu', false);
        } else {
            $alert = Helper::setAlertError('Une erreur se produit ...');
        };
        self::listesPagesAction($alert);
    }

    public function updateAction()
    {
        $id = $_REQUEST['id'] ?? '';
        $configForm = $this->contents->getFormContents()['update'];
        $configForm['values'] = (array)$this->contents->getOneBy(['id' => $id]);
        self::renderContentsView(null, $configForm);
    }

    public function updateContentAction()
    {
        $configForm = $this->contents->getFormContents()['update'];
        $alert = self::push($configForm,  'update');
        if($_REQUEST){
            if($_REQUEST['type'] === 'page'){
                self::listesPagesAction($alert);
            }
            self::listesArticlesAction($alert);
        }
    }

    private function renderContentsView( $alert, array $configForm)
    {
        $view = new View("admin/contents/create_contents", 'back');
        if (!empty($alert)) $view->assign('alert', $alert);
        $view->assign('configFormPage', $configForm);
    }


    public function listesPagesAction($alert = null): void
    {
        $pages = $this->contents->getAllBy(['type' => 'page']);
        $view = new View('admin/contents/pages_lists', 'back');
        if (!empty($alert)) $view->assign('alert', $alert);
        $view->assign('pages', $pages);
    }

    public function listesArticlesAction($alert = null): void
    {
        $articles = $this->contents->getAllBy(['type' => 'article']);
        $view = new View('admin/contents/article_lists', 'back');
        if (!empty($alert)) $view->assign('alert', $alert);
        $view->assign('articles', $articles);
    }

    private function push($configForm, $action)
    {
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];
        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }
            $validator = new Validator($configForm, $data);
            $typeName = $data['type'] === 'article' ? 'Article' : 'Page';
            $errors = $validator->getErrors();
            if (empty($errors) && (!$this->contents->getOneBy(['title' => $data['title']]) || isset($_REQUEST['id']) )) {
                isset($_REQUEST['id']) ? $this->contents->__set('id', $_REQUEST['id']) : null;
                $fileName = Helper::uploadImage('public/uploads/contents/');
                $published = isset($data['published']) ? 1 : 0;
                $this->contents->__set('type', $data['type']);
                $this->contents->__set('slug',  $data['slug']);
                $this->contents->__set('title', $data['title']);
                $this->contents->__set('description', $data['description']);
                $this->contents->__set('content', $data['content']);
                $this->contents->__set('header', " "); // ?????????
                $this->contents->__set('author', 1); // ?????????
                $this->contents->__set('img_dir', $fileName);
                $this->contents->__set('published',$published);
                $this->contents->save();

                return Helper::getAlertPropsByAction($action, $typeName, $data['type'] === 'article' ? false : true);
            } else {
                if(empty($errors)){
                    return Helper::setAlertError($typeName.' existe déjà');
                }
                return Helper::setAlertErrors($errors);
            }
        }
        return false;
    }
}
