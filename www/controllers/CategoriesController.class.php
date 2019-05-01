<?php

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
        $type = $_REQUEST['type'];

        if (isset($id)) {

            $category = new Categories();
            $category->delete(["id" => $id]);
        }

        if (isset($type)) header("Location: " . Routing::getSlug("Categories", "$type") . "?deleted");
        else header("Location: " . Routing::getSlug("Categories", "index") . "?deleted");
    }

    /**
     * Render categories function
     *
     * @param string $type  [article | album]
     * @return void  
     */
    private function renderCategory(string $type)
    {
        $category = new Categories();
        $configForm = $type === 'album' ? $category->getFormAlbumCategories() : $category->getFormArticleCategories();

        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($_POST)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            $exist = $category->getOneBy(['type' => 'article']);

            if (empty($validator->errors && !$exist)) {
                foreach ($data as $key => $value) {
                    $category->__set($key, $value);
                }
                $category->__set('type', $type);
                $category->save();
            } else {
                $alert['danger'][] = $validator->errors;
            }
        }

        $view = new View("admin/categories/$type", 'back');
        $view->assign('configFormCategory', $configForm);
        $view->assign($type . 'Categories', $category->getAllBy(['type' => $type]));
    }
}
