<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Routing;
use Songfolio\Models\Contents;
use Songfolio\Models\Menus;
use Songfolio\Models\Users;

class AdminController{

    public function defaultAction()
    {
        $nb_page = (new Contents())->getByCustomQuery(['type' => 'page'], 'COUNT(*) as nb_page');;
        $view = new View("admin/dashboard", "back");
        $view->assign('nb_page', $nb_page['nb_page']);
    }

    /* Menus */
    public function menusAction()
    {
        $v = new View("admin/menus", "back");
        $v->assign('menus', (new Menus())->getAllData());
    }
    public function menusAddAction()
    {
        $menu = new Menus();

        if(!empty($_POST['data'])){
            $menu->__set('title', $_POST['title']);
            $menu->__set('data', $_POST['data']);
            $menu->save();
            header('Location: '.Routing::getSlug('admin', 'menusEdit').'?menu='.$menu->id());
        }

        $v = new View("admin/menu_edit", "back");
        $v->assign('menu', $menu);
        $v->assign('js', ['admin_menus']);
        if(isset($alert)){
            $v->assign('alert', $alert);
        }
    }
    public function menusEditAction()
    {
        if(!isset($_GET['menu'])){
            View::show404();
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
    public function menusDelAction()
    {
        if(!isset($_GET['menu'])){
            View::show404();
        }

        $menu = new Menus($_GET['menu']);
        $menu->remove();

        header('Location: '.Routing::getSlug('admin', 'menus'));
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