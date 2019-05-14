<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\core\View;
use Songfolio\Models\Settings;

class SettingsController
{
    public function indexAction(){
        $view = new View("admin/dashboard", "back");
    }
    public function saveAction(){
        //On récupère dnas le form de quel type de setting il s'agit
        $settings_type = $_POST['data']['setting_type'];
        //On défini l'action pour ce type de setting
        $action_type = $settings_type.'Action';
        //On le retire des datas avant le save.
        unset($_POST['data']['setting_type']);

        //On créer dynamiquement le setting associé et on save ses datas.
        $settings = new Settings($settings_type);
        if(!empty($_POST)){
            $settings->__set('data', $_POST['data']);
            $settings->save();
        }

        //On lance l'action dynamique
        $this->$action_type();
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

}