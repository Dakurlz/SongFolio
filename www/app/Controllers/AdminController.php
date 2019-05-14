<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Routing;
use Songfolio\Models\Contents;
use Songfolio\Models\Menus;
use Songfolio\Models\Users;
use Songfolio\Models\Roles;

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

    /* Roles */
    public function rolesAction(){
        Users::need('role_view');

        $v = new View("admin/roles_list", "back");
        $v->assign('roles', (new Roles(null))->getAllData());
    }
    public function rolesAddAction()
    {
        Users::need('role_add');

        $role = new Roles();

        if (!empty($_POST['perms']) && !empty($_POST['name'])) {
            $role->__set('name', $_POST['name']);
            $role->__set('perms', $_POST['perms']);
            $role->save();
            header('Location: '.Routing::getSlug('admin', 'rolesEdit').'?role='.$role->id());
        }

        $v = new View("admin/roles_edit", "back");
        $v->assign('role', $role);
        $v->assign('permsList', $role->permsList());
        if(isset($alert)){
            $v->assign('alert', $alert);
        }
    }
    public function rolesEditAction()
    {
        Users::need('role_edit');

        if(!isset($_GET['role'])){
            View::show404();
        }

        $role = new Roles($_GET['role']);

        if(!empty($_POST['perms']) && !empty($_POST['name'])){
            $role->__set('name', $_POST['name']);
            $role->__set('perms', $_POST['perms']);
            $role->save();
            $alert['success'][] = 'Le role a bien été modifié.';
        }

        $v = new View("admin/roles_edit", "back");
        $v->assign('role', $role);
        $v->assign('permsList', $role->permsList());
        if(isset($alert)){
            $v->assign('alert', $alert);
        }
    }
    public function rolesDelAction()
    {
        Users::need('role_del');

        if(!isset($_GET['role'])){
            View::show404();
        }

        $menu = new Roles($_GET['role']);
        $menu->remove();

        header('Location: '.Routing::getSlug('admin', 'roles'));
    }
}