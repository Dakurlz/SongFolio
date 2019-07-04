<?php

declare(strict_types=1);

namespace Songfolio\controllers;

use Songfolio\Core\View;
use Songfolio\Core\Install;
use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Core\Validator;
use Songfolio\Models\Settings;
use Songfolio\Models\Users;

class InstallController{

    private $install;

    public function __construct(Install $install){
        $this->install = $install;
    }

    public function indexAction(){
        $view = new View("install/index", "install");
    }

    public function bddAction(){
        if(!empty($_POST)){
            if($_POST['db']){
                if(BaseSQL::tryConnection($_POST['db'])){
                    $this->install->initDb($_POST['db']);
                    header('Location: '.Routing::getSlug('install', 'config'));
                    exit;
                }else{
                    $_SESSION['alert']['danger'][] = "Nous n'arrivons pas à nous connecter à votre base de donnée, merci de vérifier les informations mentionnées.";
                }
            }
        }
        $view = new View("install/bdd", "install");
        $view->assign('formDb', $this->install->getFormDb());
    }

    public function configAction(){
        if(!empty($_POST)){
            $config = new Settings('config');
            $config->__set('data', $_POST['data']);
            $config->save();
            header('Location: '.Routing::getSlug('install', 'user'));
            exit;
        }
        $view = new View("install/config", "install");
        $view->assign('formConfig', $this->install->getFormConfig());
    }

    public function userAction(){
        $userForm = $this->install->getFormUser();

        if(!empty($_POST)){

            $method = $userForm["config"]["method"];
            $data = $GLOBALS["_" . $method];

            if ($_SERVER["REQUEST_METHOD"] == $method && !empty($data)) {
                $validator = new Validator($userForm, $data);
                if(!$validator->getErrors()){
                        $user = new Users(0);
                        $user->__set('first_name', $data["first_name"]);
                        $user->__set('last_name', $data["last_name"]);
                        $user->__set('email', $data["email"]);
                        $user->__set('password', $data["password"]);
                        $user->__set('role_id', 1);
                        $user->__set('undeletable', 1);
                        $user->save();

                        $this->install->finishInstall();

                        header('Location: '.Routing::getSlug('users', 'login'));
                        exit;
                }else{
                    $_SESSION['alert']['danger'] = $validator->getErrors();
                }
            }
        }
        $view = new View("install/user", "install");
        $view->assign('formUser', $userForm);
    }
}