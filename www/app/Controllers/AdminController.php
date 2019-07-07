<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Routing;
use Songfolio\Models\Contents;
use Songfolio\Models\Users;
use Songfolio\Models\Roles;

class AdminController{

    public function defaultAction()
    {
        Users::need('access_admin');

        $nb_page = (new Contents())->getByCustomQuery(['type' => 'page'], 'COUNT(*) as nb_page');;
        $view = new View("admin/dashboard", "back");
        $view->assign('nb_page', $nb_page['nb_page']);
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