<?php

namespace Songfolio\Controllers;

use Songfolio\Models\Users;
use Songfolio\Core\View;
use Songfolio\Core\Routing;
use Songfolio\Models\Menus;

class MenusController
{
    private $menu;

    public function __construct(Menus $menu)
    {
        $this->menu = $menu;

        Users::need('menu_view');
    }

    public function menusAction()
    {
        $v = new View("admin/menus", "back");
        $v->assign('menus', $this->menu->getAllData());
    }

    public function menusAddAction()
    {
        Users::need('menu_add');

        $menu = new Menus();

        if(!empty($_POST['data'])){
            $menu->__set('title', $_POST['title']);
            $menu->__set('data', $_POST['data']);
            $menu->save();
            $_SESSION['alert']['success'][] = 'Le menu a bien été créé.';
            header('Location: '.Routing::getSlug('menus', 'menusEdit').'?menu='.$menu->id());
            exit;
        }

        $v = new View("admin/menu_edit", "back");
        $v->assign('menu', $menu);
        $v->assign('js', ['admin_menus']);

    }

    public function menusEditAction()
    {
        Users::need('menu_edit');

        if(!isset($_GET['menu'])){
            View::show404();
        }

        $menu = new Menus($_GET['menu']);

        if(!empty($_POST)){
            $menu->__set('title', $_POST['title']);
            $menu->__set('data', $_POST['data']);
            $menu->save();
            $_SESSION['alert']['success'][] = 'Le menu a bien été modifié.';
        }

        $v = new View("admin/menu_edit", "back");
        $v->assign('menu', $menu);
        $v->assign('js', ['admin_menus']);
 
    }

    public function menusDelAction()
    {
        Users::need('menu_del');

        if(!isset($_GET['menu'])){
            View::show404();
        }

        $menu = new Menus($_GET['menu']);
        $menu->remove();

        $_SESSION['alert']['info'][] = 'Le menu a été supprimé.';

        header('Location: '.Routing::getSlug('menus', 'menus'));
    }
}
