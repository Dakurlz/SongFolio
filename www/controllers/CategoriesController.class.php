<?php

class CategoriesController
{
    public function indexAction()
    {
        $category = new Categories();
        
        $configForm = $category->getFormRegister();
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_".$method];
        
        
        if(!empty($_POST)){
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            $exist = in_array($data['name'], array_column($category->getAllData(), 'name'));

            if (empty($validator->errors) && !$exist) {
                $category->__set('name', $data['name']);
                $category->save();
            }else{
                $alert['danger'][] = $validator->errors;
            }
        }
        
        $view = new View('categories/index', 'back');
        $view->assign('configFormCategory', $configForm);
        $view->assign('categories', $category->getAllData());
        
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