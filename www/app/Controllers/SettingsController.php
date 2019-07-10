<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\PHPMailer;
use Songfolio\core\View;
use Songfolio\Core\Routing;
use Songfolio\Core\Helper;
use Songfolio\Models\Settings;

class SettingsController
{

    public function indexAction(){
        $view = new View("admin/dashboard", "back");
    }
    public function saveAction(){
        //On récupère dnas le form de quel type de setting il s'agit
        $settings_type = $_POST['data']['setting_type'];
        //On le retire des datas avant le save.
        unset($_POST['data']['setting_type']);

        foreach($_POST['data'] as $key => $value){
            if(empty($value)){
                unset($_POST['data'][$key]);
            }
        }

        //On créer dynamiquement le setting associé et on save ses datas.
        $settings = new Settings($settings_type);
        if(!empty($_POST)){
            $settings->__set('data', $_POST['data']);
            $settings->save();
        }

        //Dans le cas ou on est dans le template, on lance l'action associé
        if($settings_type == 'template'){
            $this->saveTemplate($_POST['data']);
        }

        //On lance l'action dynamique
        header('Location: '.Routing::getSlug('settings', $settings_type));
    }

    public function saveTemplate($datas){
        //Change config file
        $schema_css = 'public/css/schemas/generate.css';
        $result_css = 'public/css/generated.css';
        $edited_css = file_get_contents($schema_css);
        foreach($datas as $key => $value){
            if($key == 'title_font_name' || $key == 'text_font_name'){
                $edited_css = str_replace("%".str_replace('name', 'css', $key)."%", Helper::getGoogleFontsCss($value), $edited_css);
            }
            $edited_css = str_replace("%{$key}%", $value, $edited_css);
        }
        file_put_contents($result_css, $edited_css);
    }

    public function configAction(){
        $setting = new Settings('config');
        $view = new View("admin/settings/config", "back");
        $view->assign("settingsForm", $setting->getForm('config'));
    }

    public function templateAction(){
        $setting = new Settings('template');
        $view = new View("admin/settings/template", "back");
        $view->assign("settingsForm", $setting->getForm('template'));
    }

    public function headerAction(){
        $setting = new Settings('header');
        $view = new View("admin/settings/header", "back");
        $view->assign("settingsForm", $setting->getForm('header'));
    }

    public function footerAction(){
        $setting = new Settings('footer');
        $view = new View("admin/settings/footer", "back");
        $view->assign("settingsForm", $setting->getForm('footer'));
    }
    public function mailAction(){
        $setting = new Settings('mail');
        $view = new View("admin/settings/mail", "back");
        $view->assign("settingsForm", $setting->getForm('mail'));
        $view->assign("settingsForms", $setting->getForm('send_mail'));
        if(!empty($_POST)){
            $this->sendMail($_POST['user_email'],"Test d'envoie de mail","Bonjour<br><br> la configuration de l'envoie de mail fonctionne !");
        }

    }
    public function  sendMail($adresse,$subject,$body){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->addAddress($adresse);
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    =$body;
        //$mail->SMTPDebug = 2 ;

        if(!$mail->send()) {
            $_SESSION['alert']['danger'][] = "Le message n'a pas pu être envoyé";
            $_SESSION['alert']['danger'][] = ".$mail->ErrorInfo.";
        } else {
            $_SESSION['alert']['success'][] = "Un mail à été envoyé à l'adresse indiquée.";
        }
    }

}