<?php

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Validator;
use Songfolio\Core\Helper;
use Songfolio\Models\Categories;


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
        self::renderCategoryView('article', self::push( 'article', 'create'));
    }

    public function albumAction()
    {
        self::renderCategoryView('album', self::push( 'album', 'create'));
    }

    public function eventAction()
    {
        self::renderCategoryView('event', self::push( 'event', 'create'));
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

        if (isset($id)) {
            $this->category->delete(["id" => $id]);
            $alert = Helper::getAlertPropsByAction('delete', 'Categorie', true);
        } else {
            $alert = Helper::setAlertError('Une erreur se produit ...');
        };
        self::renderCategoryView($type, $alert);
    }

    public function updateAction()
    {
        $id = $_REQUEST['id'] ?? '';
        $type = $_REQUEST['type'] ?? '';
        $configForm = self::getConfigForm($type, 'update');
        $configForm['values'] = (array)$this->category->getOneBy(['id' => $id]);
        $view = new View("admin/categories/$type", 'back');
        $view->assign('configFormCategory', $configForm);
    }

    public function updateAlbumAction()
    {
        self::renderCategoryView('album',self::push('album', 'update') );
    }

    public function updateArticleAction()
    {
        self::renderCategoryView('article', self::push( 'article', 'update') );
    }

    public function updateEventAction()
    {
        self::renderCategoryView('event',self::push('event', 'update') );
    }

    /**
     * @param $type
     * @param $alert
     */
    private function renderCategoryView($type, $alert)
    {
        $view = new View("admin/categories/$type", 'back');
        if (!empty($alert)) $view->assign('alert', $alert);
        $view->assign('configFormCategory', self::getConfigForm($type, 'create'));
        $view->assign($type . 'Categories', $this->category->getAllBy(['type' => $type]));
    }

    /**
     * @param string $type
     * @param string $typeForm
     * @return array
     */
    private function getConfigForm(string $type, string $typeForm): array
    {

        switch ($type){
            case 'album':
                return $this->category->getFormAlbumCategories()[$typeForm];
                break;
            case  'article':
                return $this->category->getFormArticleCategories()[$typeForm];
                break;
            case 'event':
                return $this->category->getFormEventCategories()[$typeForm];
                break;
        }
        return [];
    }

    /**
     * Undocumented function
     *
     * @param [type] $configForm
     * @param [type] $type
     * @return array|bool
     */
    private function push($type, $action)
    {
        $configForm = self::getConfigForm($type, $action);
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
                isset($_REQUEST['id']) ? $this->category->__set('id', $_REQUEST['id']) : null;
                $this->category->__set('type', $type);
                $this->category->save();
                return Helper::getAlertPropsByAction($action, 'Categorie', true);
            } else {
                if(empty($errors)){
                    return Helper::setAlertError('Categorie existe déjà');
                }
                return Helper::setAlertErrors($errors);
            }
        }
        return false;
    }
}
