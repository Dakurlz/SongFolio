<?php

declare(strict_types=1);

namespace app\Controllers;

use app\Core\View;
use app\Models\Menus;
use app\Models\Users;

class AdminController{

    public function defaultAction()
    {
        new View("dashboard", "back");
    }

    /* Menus */
    public function menusAction()
    {
        $v = new View("admin/menus", "back");
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

        $v = new View("admin/menu_edit", "back");
        $v->assign('menu', $menu);
        $v->assign('js', ['admin_menus']);
        if(isset($alert)){
            $v->assign('alert', $alert);
        }
    }

    /* Users */
    public function loadUserAction(){
        $user = new Users();
        
        $v = new View("user", "back");
        $v->assign('allUsers', $user->getAllData());
    }

    public function loadPagesAction(){
        $v = new View("pages", "back");
    }

    public function loadAlbumAction(){
        $v = new View("album", "back");
    }
}