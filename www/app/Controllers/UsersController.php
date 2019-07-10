<?php

declare (strict_types = 1);

namespace Songfolio\controllers;

use Songfolio\Core\Alert;
use Songfolio\Core\Oauth\OAuthSDK;
use Songfolio\core\View;
use Songfolio\core\Routing;
use Songfolio\core\Validator;
use Songfolio\models\Users;
use Songfolio\Models\Roles;
use Songfolio\Models\Settings;
use Songfolio\Core\Oauth\Facebook;
use Songfolio\core\PhpMailer;

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
                $user = new Users(["email" => $data["email"]]);
                if ($this->checkUser($data['email'])) {
                    $_SESSION['alert']['danger'][] = "L'adresse mail entré correspond déjà à un compte existant compte.";
                } else {
                    if (empty($configForm["errors"])) {
                        $this->user->__set('first_name', $data["first_name"]);
                        $this->user->__set('last_name', $data["last_name"]);
                        $this->user->__set('email', $data["email"]);
                        $this->user->__set('password', $data["password"]);
                        $this->user->save();
                        $_SESSION['alert']['success'][] = 'Votre compte à bien été créer.';
                        header('Location: ' . Routing::getSlug("users", "login"));
                    } else {
                        foreach ($configForm["errors"] as $error) {
                            $_SESSION['alert']['danger'][] = $error;
                        }
                    }
                }
            }
        }

        $v = new View("user_register", "front");
        $v->assign("configFormRegister", $configForm);
    }

    public function oauthAction(): void
    {
        if($_GET['provider']){
            $providerClass = "Songfolio\Core\Oauth\Providers\\".$_GET['provider'];

            $provider_obj = new $providerClass();

            $access_token = $provider_obj->getAccessTokenUrl($_GET['code']);

            if($access_token){


                print_r($provider_obj->getUsersInfo($access_token));
                $user_infos = json_decode($provider_obj->getUsersInfo($access_token), true);

                $user = new Users();
                $user->oAuthLogin($provider_obj->getProviderName(), $user_infos);

            }
        }else{
            header('Location: ' . Routing::getSlug("users", "login"));
        }
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
                if(empty($configForm["errors"])) {
                    if($this->checkUser($data['email'])){
                        if ($user->getOneBy(['email' => $data['email']], true) && password_verify($data['password'], $user->__get('password'))) {
                            $user->setLoginToken();
                            if (isset($_GET['redirect'])) {
                                $redirect = htmlspecialchars(urldecode($_GET['redirect']));
                                header('Location: ' . $redirect);
                                exit;
                            }
                            header('Location: ' . Routing::getSlug("users", "dashboard"));
                        } else {
                            $_SESSION['alert']['danger'][] = "Le mot de passe entré est incorrect.";
                        }
                    }else{
                        $_SESSION['alert']['danger'][] = "L'adresse mail entré ne correspond à aucun compte.";
                    }
                }else{
                    foreach ($configForm["errors"] as $error) {
                        $_SESSION['alert']['danger'][] = $error;
                    }
                }
            }
        }

        $sdk = new OAuthSDK();

        $v = new View("user_login", "front");
        $v->assign("configFormLogin", $configForm);
        $v->assign("sdk", $sdk);
    }
    public function checkUser($mail){
        $user = new Users(["email" => $mail]);
        if($user->__get('id')==true){
           return true;
        }else{
          return false;
        }

    }
    public function logoutAction(): void
    {
        unset($_SESSION['user']);
        setcookie('token', '', -1, '/');
        $_SESSION['alert']['success'][] = 'Vous avez été correctement déconnecté.';
        header('Location: ' . Routing::getSlug("users", "login"));
    }

    public function forgetPasswordAction(): void
    {
        $configForm = $this->user->forgetPassword();
        $v = new View("user_forgetPassword", "front");
        $v->assign('forgetPassword', $configForm);

        if (!empty($_POST)) {
            $user = new Users(["email" => $_POST['user_email']]);
            if ($user->__get('id')==true) {

                $token = $this->generateToken();
                $user->__set('pwd_token',$token);
                $user->save();
                $mail = new PHPMailer();

               // $mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to u=$mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication

                $mail->addAddress($user->__get('email'));     // Add a recipient
               // $mail->addAddress('gatay.bryan@gmail.com');
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = "Bonjour<br><br> Cliquer sur le lien pour changer votre mot de passe. http://localhost/changer_mot_de_passe?t=$token";

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $_SESSION['alert']['success'][] = "Un mail à été envoyé à l'adresse indiquée.";
                }

            }else{
                 $_SESSION['alert']['danger'][] = "L'adresse mail n'a pas été trouvé";
            }
        }
    }

    public function createUsersAction()
    {
        Users::need('user_add');

        $configForm = $this->user->getFormUsers()['create'];
        if(!empty($_POST)){
            self::push($configForm, 'create');
            header('Location: '.Routing::getSlug('Users', 'listUsers'));
            exit;
        }
        $roles = $this->role->getAllData();
        $configForm['data']['role']['options'] = Roles::prepareRoleToSelect($roles);
        self::renderUsersView($configForm);
    }

    public function updateAction()
    {
        Users::need('user_edit');

        if(empty($_GET['id'])){
            header('Location: '.Routing::getSlug('Users', 'listUsers'));
            exit;
        }

        $id = $_REQUEST['id'] ?? '';
        $configForm = $this->user->getFormUsers()['update'];

        if(!empty($_POST)){
            self::push($configForm,  'update');
            header('Location: '.Routing::getSlug('Users', 'update').'?id='.$id);
            exit;
        }

        $configForm['values'] = (array)$this->user->getOneBy(['id' => $id]);
        unset($configForm['values']['password']);

        $configForm['data']['role']['options'] = Roles::prepareRoleToSelect($this->role->getAllData());
        self::renderUsersView($configForm);
    }

    public function listUsersAction($alert = null)
    {
        $users = $this->user->getAllData();
        $roles = $this->role->getAllData();
        $view = new View('admin/users/list','back');
        $view->assign('users',$users);
        $view->assign('roles', $roles);
    }


    public function deleteAction()
    {
        Users::need('user_del');
        $id = $_GET['id'];
        if (isset($id)) {
            $user = new Users($id);
            if($user->__get('undeletable') != 1){
                $user->remove();
                $_SESSION['alert']['success'][] = "L'utilisateur a bien été supprimé.";
            }else{
                $_SESSION['alert']['danger'][] = "Vous ne pouvez pas supprimer un utilisateur principal";
            }
        } else {
            $_SESSION['alert']['danger'][] = "Une erreur s'est produite.";
        };
        header('Location: '.Routing::getSlug('Users', 'listUsers'));
        exit;
    }

    public function changePasswordAction()
    {
        if (!isset($_GET['t'])) {
            $v = new View("404", "front");
        }else{
        $user = new Users(["pwd_token" => $_GET['t']]);
        if ($user->__get('id') == false) {
            $v = new View("404", "front");
        } else {
            $v = new View("user_changePassword", "front");
            $configForm = $this->user->getFormNewPwd();
            $v->assign('configFormUsers', $configForm);
        }
        if (!empty($_POST)) {
            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_" . $method];
            $validator = new Validator($configForm, $data);
            $configForm["errors"] = $validator->getErrors();
            if (!empty($configForm["errors"])) {
                foreach ($configForm["errors"] as $error) {
                    $_SESSION['alert']['danger'][] = $error;
                }
            } else {
                $user->__set('password', $_POST['valid_new_pwd']);
                $user->__set('pwd_token', null);
                $user->save();
                header('Location: ' . Routing::getSlug("users", "login"));
            }

        }
    }
    }

    private function renderUsersView(array $configForm)
    {
        $view = new View('admin/users/create', 'back');
        $view->assign('configFormUsers', $configForm);
    }

    private function push($configForm, $action)
    {
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];
        if (!empty($data) && $_SERVER["REQUEST_METHOD"] == $method) {

            $validator = new Validator($configForm, $data);
            if(!$validator->getErrors()){

                //On check si l'email est pas déjà pris, en ajout et en modif d'user
                $user_checkmail = $this->user->getOneBy(['email' => $data['email']]);
                if( (!isset($_GET['id']) && $user_checkmail) || ($user_checkmail && $user_checkmail['id'] != $_GET['id']) ){

                    $_SESSION['alert']['danger'][] = 'Ce mail est déjà lié à un autre utilisateur';
                    return;

                } else {

                    if( isset($_GET['id']) ){
                        $user = new Users($_GET['id']);
                    }else{
                        $user = new Users('empty');
                    }

                    $user->__set('role_id', (int)$data['role']);
                    if($data['password']){
                        $user->__set('password', $data['password']);
                    }
                    $user->__set('email', $data['email']);
                    $user->__set('first_name', $data['first_name']);
                    $user->__set('last_name', $data['last_name']);
                    if($action == 'create'){
                        $user->__set('undeletable', 0 );
                    }

                    $user->save();

                    if($action == 'create'){
                        $_SESSION['alert']['success'][] = "L'utilisateur a bien été créé.";
                        return;
                    }
                    if($action == 'update'){
                        $_SESSION['alert']['success'][] = "Modifications prises en compte";
                        return;
                    }
                }

            }else{
                $_SESSION['alert']['danger'] = $validator->getErrors();
                return;
            }
        }
        return;

    }

    private function generateToken(){
        $length=30;
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
        }
        return $string;;
    }
}
