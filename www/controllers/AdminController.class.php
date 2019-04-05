<?php

declare(strict_types=1);

class AdminController{

    public function defaultAction()
    {
        $v = new View("dashboard", "back");
    }
    public function menusAction()
    {
        $v = new View("admin_menus", "back");
        $v->assign('menus', (new Menus())->getAllData());
    }
    public function menusEditAction()
    {
        if(!isset($_GET['menu'])){
            view::show404();
        }

        $menu = new Menus($_GET['menu']);

        if(!empty($_POST['data'])){
            $menu->__set('data', $_POST['data']);
            $menu->save();
            $alert['success'][] = 'Le menu a bien été modifié.';
        }

        $v = new View("admin_menu_edit", "back");
        $v->assign('menu', $menu);
        if(isset($alert)){
            $v->assign('alert', $alert);
        }
    }

    public function loadUserAction(){
        
      $v = new View("user", "back");
    }
}