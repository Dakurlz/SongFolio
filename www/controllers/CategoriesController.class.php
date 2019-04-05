<?php

class CategoriesController
{
    public function indexAction()
    {
        $category = new Categories();
        
        $configForm = $category->getFormRegister();
        
        
        $set = $this->set($category, $configForm);
        
        $view = new View('categories/index', '_back');
        // $allCategories = ;
        $view->assign('configFormCategory', $configForm);
        $view->assign('categories', $category->getAllData());
        
    }


    private function set($category, $configForm)
    {
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_".$method];
        
        
        if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
            return false;
        }

        $validator = new Validator($configForm, $data);
        $exist = in_array($data['name'], array_column($category->getAllData(), 'name'));

        if (empty($validator->errors) && !$exist) {
            $category->setName($data["name"]);
            $category->setSlug('');
            $category->save();
            return true;
        }
        return $validator->errors;
    }

    public function deleteAction()
    {
        $id = $_REQUEST['id'];

        if(isset($id)){

            $category = new Categories();
            $category->delete([ "id" => $id ]);

        }

        header("Location: " . Routing::getSlug("Categories", "index") . "?deleted");

    }




}