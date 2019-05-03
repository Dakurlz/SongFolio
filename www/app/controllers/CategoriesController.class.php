<?php

namespace app\Controllers;

use app\Core\View;
use app\Core\Validator;
use app\Core\Helper;
use app\Models\Categories;


class CategoriesController
{
    public function indexAction()
    {
        new View('admin/categories/index', 'back');
    }

    public function articleAction()
    {
        self::renderCategory('article');
    }

    public function albumAction(): void
    {
        self::renderCategory('album');
    }

    /**
     * Delete function
     *
     * @return void
     */
    public function deleteAction()
    {
        $id = $_REQUEST['id'];
        // $type = $_REQUEST['type'];


        if (isset($id)) {

            $category = new Categories();
            $category->delete(["id" => $id]);
        }

        // $this->renderCategory($type, 'delete');

        // if (isset($type)) header("Location: " . Routing::getSlug("Categories", "$type") . "?daction=deleted");
        // else header("Location: " . Routing::getSlug("Categories", "index") . "?action=deleted");
    }

    public function updateAction()
    { }

    /**
     * @param string $type
     * @param string|null $action
     * @return bool
     */
    private function renderCategory(string $type, string $action = null)
    {
        $category = new Categories();
        $configForm = $type === 'album' ? $category->getFormAlbumCategories() : $category->getFormArticleCategories();

        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];

        $view = new View("admin/categories/$type", 'back');

        $alert = [];
        if (!empty($_POST)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            $exist = $category->getOneBy(['name' => $data['name']]);

            $errors = $validator->getErrors();
            if (empty($errors) && !$exist) {
                foreach ($data as $key => $value) {
                    $category->__set($key, $value);
                }
                $category->__set('type', $type);
                $category->save();
                debug(Helper::getAlertPropsByAction('create', 'Categorie', true));
                $alert += Helper::getAlertPropsByAction('create', 'Categorie', true);
            } else {
                $alert = Helper::setAlertErrors($errors);
            }
        }
        debug($alert);
        if (sizeof($alert) !== 0) $view->assign('alert', $alert);
        $view->assign('configFormCategory', $configForm);
        $view->assign($type . 'Categories', $category->getAllBy(['type' => $type]));
    }
}
