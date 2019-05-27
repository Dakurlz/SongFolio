<?php

declare (strict_types = 1);

namespace Songfolio\controllers;

use Songfolio\Core\Helper;
use Songfolio\core\View;
use Songfolio\core\Routing;
use Songfolio\core\Validator;
use Songfolio\Models\Categories;
use Songfolio\models\Users;
use Songfolio\Models\Roles;

class UsersController
{

    private $user;
    private $role;

    public function __construct(Users $user, Roles $role)
    {
        $this->user = $user;
        $this->role = $role;
    }


    public function defaultAction(): void
    {
        echo "User default";
    }

    public function dashboardAction(): void

    {   
        $configForm = $this->user->getFormModifyPwd();
        $v = new View("user_dashboard", "front");
        $v->assign('user', $this->user);
        $v->assign('FormModifyPwd',$configForm);
        if(!empty($_POST)){
            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_" . $method];
            if (!password_verify($data['old_pwd'],$this->user->password)) {
                $configForm["errors"]=[];
                array_push($configForm["errors"],"Votre mot de passe actuel que vous avez saisit est incorrect.");
            }else{
                $validator = new Validator($configForm, $data);
                $configForm["errors"] = $validator->getErrors();
            }
            if(!empty( $configForm["errors"])){
                $v->assign('alert', $configForm["errors"]);
                $v->assign('active','active');
            }else{
                $this->modifyPwdAction($data['new_pwd']);
                $v->assign('success', "Votre mot de passe à été modifier.");
            }
        }
    }
    
    public function modifyPwdAction($pwd) : void
    {   
       $this->user->__set('password',$pwd);
       $this->user->save();
    }

    public function registerAction(): void
    {
        if ($this->user->is('connected')) {
            header('Location: ' . Routing::getSlug('users', 'dashboard'));
        }

        $configForm = $this->user->getFormRegister();

        if (!empty($_POST)) {
            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_" . $method];

            if ($_SERVER["REQUEST_METHOD"] == $method && !empty($data)) {
                $validator = new Validator($configForm, $data);
                $configForm["errors"] = $validator->getErrors();

                if (empty($configForm["errors"])) {
                    $this->user->__set('username', $data["username"]);
                    $this->user->__set('email', $data["email"]);
                    $this->user->__set('password', $data["password"]);
                    $this->user->save();
                }
            }
        }

        $v = new View("user_register", "front");
        $v->assign("configFormRegister", $configForm);
    }

    public function loginAction(): void
    {
        if ($this->user->is('connected')) {
                header('Location: ' . Routing::getSlug('users', 'dashboard'));
            }

        $user = new Users();
        $configForm = $user->getFormLogin();

        if (!empty($_POST)) {
           
            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_" . $method];
            
            if ($_SERVER["REQUEST_METHOD"] == $method && !empty($data)) {
                $validator = new Validator($configForm, $data);
                $configForm["errors"] = $validator->getErrors();
                var_dump($validator);
                if (empty($configForm["errors"])) {
                    if ($user->getOneBy(['username' => $data['username']], true) && password_verify($data['password'], $user->__get('password'))) {

                        $token = md5(substr(uniqid().time(), 4, 10));
                        setcookie('token', $token, time() + (86400 * 7), "/");

                        $user->__set('login_token', $token);
                        $user->save();
                        $_SESSION['user'] = $user->__get('id');

                        if (isset($_GET['redirect'])) {
                                $redirect = htmlspecialchars(urldecode($_GET['redirect']));
                                header('Location: ' . $redirect);
                                exit;
                            }

                        header('Location: ' . Routing::getSlug("users", "dashboard"));
                    } else {
                        $configForm["errors"][] = "Incorrect";
                    }
                }
            }
        }

        $v = new View("user_login", "front");
        $v->assign("configFormLogin", $configForm);
    }

    public function logoutAction(): void
    {
        unset($_SESSION['user']);
        setcookie('token', '', -1, '/');

        header('Location: ' . BASE_URL);
    }

    public function forgetPasswordAction(): void
    {
        new View("user_forgetPassword", "front");
    }

    public function createUsersAction()
    {
        Users::need('user_add');

        $configForm = $this->user->getFormUsers()['create'];
        $roles = $this->role->getAllData();
        $alert = self::push($configForm, 'create');
        $configForm['data']['role']['options'] = Roles::prepareRoleToSelect($roles);
        self::renderUsersView($alert, $configForm);
    }

    public function updateAction()
    {
        Users::need('user_edit');

        $id = $_REQUEST['id'] ?? '';
        $configForm = $this->user->getFormUsers()['update'];
        $configForm['values'] = (array)$this->user->getOneBy(['id' => $id]);
        $configForm['data']['role']['options'] = Roles::prepareRoleToSelect($this->role->getAllData());
        self::renderUsersView(null, $configForm);
    }

    public function updateUsersAction()
    {
        $configForm = $this->user->getFormUsers()['update'];
        $alert = self::push($configForm,  'update');
        self::listUsersAction($alert);
    }

    public function listUsersAction($alert = null)
    {
        $users = $this->user->getAllData();
        $roles = $this->role->getAllData();
        $view = new View('admin/users/list','back');
        $view->assign('users',$users);
        $view->assign('roles', $roles);
        if (!empty($alert)) $view->assign('alert', $alert);
    }


    public function deleteAction()
    {
        Users::need('user_del');
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $this->user->delete(["id" => $id]);
            $alert = Helper::getAlertPropsByAction('delete', 'Utilisateur', false);
        } else {
            $alert = Helper::setAlertError('Une erreur se produit ...');
        };

        self::listUsersAction($alert);
    }

    private function renderUsersView($alert, array $configForm)
    {
        $view = new View('admin/users/create', 'back');
        if (!empty($alert)) $view->assign('alert', $alert);
        $view->assign('configFormUsers', $configForm);
    }

    private function push($configForm, $action)
    {

        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];
        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] !== $method || empty($data)) {
                return false;
            }
            $validator = new Validator($configForm, $data);
            $errors = $validator->getErrors();

            if (empty($errors) && (!$this->user->getOneBy(['username' => $data['username']]) || isset($_REQUEST['id']))) {
                isset($_REQUEST['id'])  ? $this->user->__set('id', $_REQUEST['id']) : null;
                if($action === 'create') $this->user->__remove('id') ;

                $this->user->__set('username', $data['username']);
                $this->user->__set('role_id', (int)$data['role']);
                $this->user->__set('password', $data['password']);
                $this->user->__set('email', $data['email']);
                $this->user->__set('first_name', $data['first_name']);
                $this->user->__set('last_name', $data['last_name']);
                $this->user->save();

                return Helper::getAlertPropsByAction($action, 'Utilisateur', false);
            } else {
                if (empty($errors)) {
                    return Helper::setAlertError('Utilisateur existe déjà');
                }
                return Helper::setAlertErrors($errors);
            }
        }
        return false;

    }
}
