<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Routing;
use Songfolio\Models\Contents;
use Songfolio\Models\Users;
use Songfolio\Models\Roles;
use Songfolio\Models\Comments;

class AdminController
{

    private $content;
    private $comment;
    private $user;

    public function __construct(Contents $content,Users $user, Comments $comment)
    {
        $this->content = $content;
        $this->comment = $comment;
        $this->user = $user;
    }

    public function defaultAction()
    {
        Users::need('access_admin');

        $nb_page = $this->content->getByCustomQuery(['type' => 'article'], 'COUNT(*) as nb_articles');
        $nb_users = $this->user->count();
        $nb_comments = $this->comment->count();
        $view = new View("admin/dashboard", "back");
        $view->assign('nb_articles', $nb_page['nb_articles']);
        $view->assign('nb_users', $nb_users['nb_users']);
        $view->assign('nb_comments', $nb_comments['nb_comments']);
    }


    /* Roles */
    public function rolesAction()
    {
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

            $_SESSION['alert']['success'][] = 'Le role a bien été ajouté.';

            header('Location: ' . Routing::getSlug('admin', 'rolesEdit') . '?role=' . $role->id());
            exit;
        }else if (!empty($_POST['perms']) || !empty($_POST['name'])){
            $_SESSION['alert']['danger'][] = 'Vous devez renseigner un titre et un droit au minimum.';
        }

        $v = new View("admin/roles_edit", "back");
        $v->assign('role', $role);
        $v->assign('permsList', $role->permsList());
    }
    public function rolesEditAction()
    {
        Users::need('role_edit');

        if (!isset($_GET['role'])) {
            View::show404();
        }

        $role = new Roles($_GET['role']);

        if (!empty($_POST['perms']) && !empty($_POST['name'])) {
            $role->__set('name', $_POST['name']);
            $role->__set('perms', $_POST['perms']);
            $role->save();
            $_SESSION['alert']['success'][] = 'Le role a bien été modifié.';
        }else if (!empty($_POST['perms']) || !empty($_POST['name'])){
            $_SESSION['alert']['danger'][] = 'Vous devez renseigner un titre et un droit au minimum.';
        }

        $v = new View("admin/roles_edit", "back");
        $v->assign('role', $role);
        $v->assign('permsList', $role->permsList());
    }
    public function rolesDelAction()
    {
        Users::need('role_del');

        if (!isset($_GET['role'])) {
            View::show404();
        }

        $user = new Users(["role_id" => $_GET['role']]);
        if(!$user->__get('id')){
            $menu = new Roles($_GET['role']);
            $menu->remove();
            $_SESSION['alert']['info'][] = 'Le role a bien été supprimé.';
        }else{
            $_SESSION['alert']['danger'][] = 'Vous ne pouvez pas supprimer un groupe utilisé par un utilisateur.';
        }

        header('Location: ' . Routing::getSlug('admin', 'roles'));
    }
}
