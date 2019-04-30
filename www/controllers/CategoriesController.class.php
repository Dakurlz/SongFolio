<?php

class CategoriesController
{
    public function indexAction()
    {
        new View('categories/index', 'back');
    }

    public function articaleAction()
    {
        $category = new Categories();

        $configForm = $category->getFormArticleCategories()();
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($_POST)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            $exist = in_array($data['name'], array_column($category->getOneBy(['type' => 'article']), 'name'));

            if (empty($validator->errors) && !$exist) {
                $category->__set('name', $data['name']);
                $category->__set('slug', $data['slug']);
                $category->__set('type', 'articale');
                $category->save();
            } else {
                $alert['danger'][] = $validator->errors;
            }
        }

        $view = new View('categories/article', 'back');
        $view->assign('configFormCategory', $configForm);
        $view->assign('categories', $category->getOneBy(['type' => 'article']));
    }

    public function albumAction()
    {
        $category = new Categories();

        $configForm = $category->getFormAlbumCategories()();
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($_POST)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            $exist = in_array($data['name'], array_column($category->getOneBy(['type' => 'album']), 'name'));

            if (empty($validator->errors) && !$exist) {
                $category->__set('name', $data['name']);
                $category->__set('type', 'album');
                $category->save();
            } else {
                $alert['danger'][] = $validator->errors;
            }
        }

        $view = new View('categories/album', 'back');
        $view->assign('configFormCategory', $configForm);
        $view->assign('albumCategoris', $category->getOneBy(['type' => 'album']));
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
        header("Location: " . Routing::getSlug("Categories", "index") . "?deleted");
    }

    /**
     * Render categories function
     *
     * @param array $configForm
     * @param array $dataSet
     * @param string $type  [article | album]
     * @return void  
     */
    private function renderCategory(array $configForm, array $dataSet, string $type)
    {
        $category = new Categories();

        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($_POST)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            // $exist = in_array($data['name'], array_column($category->getOneBy(['type' => 'article']), 'name'));

            if (empty($validator->errors)) {
                foreach ($dataSet as $key => $value) {
                    $category->__set($key, $value);
                }
                $category->save();
            } else {
                $alert['danger'][] = $validator->errors;
            }
        }

        $view = new View("categories/$type", 'back');
        $view->assign('configFormCategory', $configForm);
        $view->assign($type . 'Categories', $category->getOneBy(['type' => $type]));
    }
}
