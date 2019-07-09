<?php

declare (strict_types = 1);

namespace Songfolio\controllers;

use Songfolio\Core\Alert;
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
                if ($user->__get('id')==true) {
                    var_dump("L'email est déjà utilisé.");
                }

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

    public function oauthAction(): void
    {
        if($_GET['provider']){
            $providerClass = "Songfolio\Core\Oauth\\".$_GET['provider'];

            $provider_obj = new $providerClass();

            $access_token = $provider_obj->getAccessTokenUrl($_GET['code']);

            if($access_token){

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
        $fb_login_url = (new Facebook())->getAuthorizationUrl();

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
                if (empty($configForm["errors"])) {
                    if ($user->getOneBy(['username' => $data['username']], true) && password_verify($data['password'], $user->__get('password'))) {

                        $user->setLoginToken();

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
        $v->assign("loginFb", $fb_login_url);
    }

    public function logoutAction(): void
    {
        unset($_SESSION['user']);
        setcookie('token', '', -1, '/');

        header('Location: ' . BASE_URL);
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
                $mail->addAddress('gatay.bryan@gmail.com');
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = "Bonjour<br><br> Cliquer sur le lien pour changer votre mot de passe. http://localhost/changer_mot_de_passe?t=$token";

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }

            }else{
                var_dump("Le mail n'a pas été trouvé");
            }
        }
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
            $alert = Alert::setAlertPropsByAction('delete', 'Utilisateur', false);
        } else {
            $alert = Alert::setAlertError('Une erreur se produit ...');
        };

        self::listUsersAction($alert);
    }

    public function changePasswordAction(){
        $token =$_GET['t'];
        $user = new Users(["pwd_token" => $_GET['t']]);
        if($user->__get('id')==false){
            $v = new View("404", "front");
        }else{
            $v = new View("user_changePassword", "front");
            $configForm = $this->user->getFormNewPwd();
            $v->assign('configFormUsers', $configForm);
        }
        if(!empty($_POST)){
            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_" . $method];
            $validator = new Validator($configForm, $data);
            $configForm["errors"] = $validator->getErrors();
            if(!empty($configForm["errors"])){
                var_dump($configForm["errors"]);
            }else{
                $user->__set('password',$_POST['valid_new_pwd']);
                $user->__set('pwd_token',null);
                $user->save();
                header('Location: ' . Routing::getSlug("users", "login"));
            }

        }
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

                return Alert::setAlertPropsByAction($action, 'Utilisateur', false);
            } else {
                if (empty($errors)) {
                    return Alert::setAlertError('Utilisateur existe déjà');
                }
                return Alert::setAlertErrors($errors);
            }
        }
        return false;

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
