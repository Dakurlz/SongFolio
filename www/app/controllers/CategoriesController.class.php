<?php

namespace app\Controllers;

use app\Core\View;
use app\Core\Validator;
use app\Core\Helper;
use app\Models\Categories;


class CategoriesController
{
    private $category;

    public function __construct(Categories $category)
    {
        $this->category = $category;
    }

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
        $type = $_REQUEST['type'];

        $alert = [];
        if (isset($id)) {

            $this->category->delete(["id" => $id]);
            $alert = Helper::getAlertPropsByAction('delete', 'Categorie', true);
        } else {
            $alert = Helper::setAlertError('Une erreur se produit ...');
        };

        $configForm = self::getConfigForm($type);

        $view = new View("admin/categories/$type", 'back');
        $view->assign('alert', $alert);
        $view->assign('configFormCategory', $configForm);
        $view->assign($type . 'Categories', $this->category->getAllBy(['type' => $type]));
    }

    public function updateAction()
    {
        $id = $_REQUEST['id'];
        $type = $_REQUEST['type'];

        $configForm = self::getConfigForm($type);
        if (isset($id)) {
            return self::push($configForm, $type, 'update');
        }

        $configForm['values'] = (array)$this->category;

        $view = new View("admin/categories/$type", 'back');
        $view->assign('configFormCategory', $configForm);
    }

    /**
     * @param string $type
     * @param string|null $action
     * @return bool
     */
    private function renderCategory(string $type)
    {
        $configForm = self::getConfigForm($type);

        $alert = self::push($configForm, $type, 'create');
        $view = new View("admin/categories/$type", 'back');

        if (!empty($alert)) $view->assign('alert', $alert);
        $view->assign('configFormCategory', $configForm);
        $view->assign($type . 'Categories', $this->category->getAllBy(['type' => $type]));
    }
    /**
     *  return form function
     *
     * @param string $type
     * @return array
     */
    private function getConfigForm(string $type): array
    {
        return $type === 'album' ? $this->category->getFormAlbumCategories() : $this->category->getFormArticleCategories();
    }

    /**
     * Undocumented function
     *
     * @param [type] $configForm
     * @param [type] $type
     * @return array|bool
     */
    private function push($configForm, $type, $action)
    {

        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];

        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);

            $errors = $validator->getErrors();
            if (empty($errors) && !$this->category->getOneBy(['name' => $data['name']])) {
                foreach ($data as $key => $value) {
                    $this->category->__set($key, $value);
                }
                $this->category->__set('type', $type);
                $this->category->save();
                return Helper::getAlertPropsByAction($action, 'Categorie', true);
            } else {
                return Helper::setAlertErrors($errors);
            }
        }
        return false;
    }
}
