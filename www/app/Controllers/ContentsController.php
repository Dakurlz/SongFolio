<?php
declare (strict_types = 1);

namespace Songfolio\Controllers;

use Songfolio\core\View;
use Songfolio\Core\Validator;
use Songfolio\core\Helper;
use Songfolio\Core\Alert;

use Songfolio\Models\Categories;
use Songfolio\Models\Contents;
use Songfolio\Models\Users;

class ContentsController
{

    private $contents;
    private $categories;
    private $user;

    public function __construct(Contents $contents, Categories $categories, Users $user)
    {
        $this->contents = $contents;
        $this->categories = $categories;
        $this->user = $user;
    }

    public function indexAction(): void
    {
        $nb_articles =  $this->contents->getByCustomQuery(['type' => 'article'], 'COUNT(*) as nb_articles');
        $nb_page =  $this->contents->getByCustomQuery(['type' => 'page'], 'COUNT(*) as nb_page');
        $view = new View('admin/contents/index', 'back');
        $view->assign('nb_articles', $nb_articles['nb_articles']);
        $view->assign('nb_pages', $nb_page['nb_page']);
    }

    public function createContentsAction(): void
    {
        Users::need('content_add');

        $configForm = self::published($this->contents->getFormContents()['create']);
        $categories = $this->categories->getAllBy(['type' => 'article']);
        $configForm['data']['category']['options'] = Categories::prepareCategoriesToSelect($categories);
        $alert = self::push($configForm, 'create');

        self::renderContentsView($alert, $configForm);
    }

    public function deleteAction(): void
    {
        Users::need('content_del');

        $id = $_REQUEST['id'];
        if (isset($id)) {
            $this->contents->delete(["id" => $id]);
            $alert = Alert::setAlertPropsByAction('delete', 'Contenu', false);
        } else {
            $alert = Alert::setAlertError('Une erreur se produit ...');
        };
        if ($_REQUEST) {
            if ($_REQUEST['type'] === 'page') {
                self::listesPagesAction($alert);
            }
            self::listesArticlesAction($alert);
        }
    }

    public function updateAction()
    {
        Users::need('content_edit');

        $id = $_REQUEST['id'] ?? '';
        $configForm = self::published($this->contents->getFormContents()['update']);
        $this->contents = $this->contents->getOneBy(['id' => $id], true);
        $configForm['values'] = (array)$this->contents;
        if ($this->contents['type'] === 'article') {
            $categories = $this->categories->getAllBy(['type' => 'article']);
            $configForm['data']['category']['options'] = Categories::prepareCategoriesToSelect($categories);
        }
        self::renderContentsView(null, $configForm);
    }

    public function updateContentAction()
    {
        $configForm = $this->contents->getFormContents()['update'];
        self::published($configForm);
        $alert = self::push($configForm,  'update');
        if ($_REQUEST) {
            if ($_REQUEST['type'] === 'page') {
                self::listesPagesAction($alert);
            }
            self::listesArticlesAction($alert);
        }
    }

    private function renderContentsView($alert, array $configForm)
    {
        $view = new View("admin/contents/create", 'back');
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
        $view->assign('categories', $this->categories->getAllBy(['type' => 'article']));
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

            if (empty($errors) && (!$this->contents->getOneBy(['slug' => $data['slug']]) || isset($_REQUEST['id']))) {
                isset($_REQUEST['id']) ? $this->contents->__set('id', $_REQUEST['id']) : null;
                $fileName = Helper::uploadImage('public/uploads/contents/', 'img_dir');
                $this->contents->__set('type', $data['type']);
                $this->contents->__set('slug',  $data['slug']);
                $this->contents->__set('title', $data['title']);
                $this->contents->__set('description', $data['description']);
                $this->contents->__set('content', $data['content']);
                $this->contents->__set('author', $this->user->__get('id'));
                isset($data['category']) ? $this->contents->__set('category_id', (int)$data['category']) : null;
                isset($fileName) ? $this->contents->__set('img_dir', $fileName) : null;
                $this->contents->__set('published', isset($data['published']) ? (int)$data['published'] : 0);
                $this->contents->__set('comment_active', isset($data['comment_active']) ? (int)$data['comment_active'] : 0);
                $this->contents->__set('indexed', isset($data['indexed']) ? (int)$data['indexed'] : 0);
                $this->contents->save();


                return Alert::setAlertPropsByAction($action, $typeName, $data['type'] === 'article' ? false : true);
            } else {
                if (empty($errors)) {
                    return Alert::setAlertError($typeName . ' existe déjà');
                }
                return Alert::setAlertErrors($errors);
            }
        }
        return false;
    }

    private function published($configForm): array
    {
        if(!Users::hasPermission('content_pub')) {
            unset($configForm['data']['published']);
        }
        return $configForm;
    }
}
