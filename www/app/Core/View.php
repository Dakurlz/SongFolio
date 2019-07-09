<?php

declare(strict_types=1);

namespace Songfolio\Core;

use Songfolio\Models\Settings;
use Songfolio\Models\Users;

class View{
    private $view;
    private $view_path;
    private $template;
    private $template_path;

    public function __construct($v, $t="back"){
        $this->setView($v);
        $this->setTemplate($t);
    }

    public function setView($view){
        $this->view = $view;
        $vPath = "app/views/".$view.".view.php";
        if(file_exists($vPath)) {
            $this->view_path = $vPath;
        }else{
            View::show404("Le views n'existe pas ". $vPath);
        }
    }

    public function setTemplate($template){
        $this->template = $template;
        $templatePath = "app/views/templates/".$template.".tpl.php";
        if($template === null){
            $this->template_path = null;
        }else{
            if(file_exists($templatePath)) {
                $this->template_path = $templatePath;

                if($template == 'front'){
                    $settings['config'] = (new Settings('config') )->get();
                    $settings['header'] = (new Settings('header') )->get();
                    $settings['footer'] = (new Settings('footer') )->get();
                    $this->assign('settings', $settings);
                }

            }else{
                die("Le template n'existe pas ". $templatePath);
            }
        }
    }

    public function addModal($modal, $config){
        $pathModal = "app/views/modals/".$modal.".mod.php";
        if(file_exists($pathModal)){
            include $pathModal;
        }else{
            die("Le modal n'existe pas :".$pathModal);
        }
    }

    public static function show404($reason = ""){
        $v = new View("404", "front");
        if($reason){
            $v->assign('reason', $reason);
        }
        exit;
    }

    public function assign($key, $value){
        $this->data[$key]=$value;
    }

    public function __destruct(){
        $user = new Users();
        if(!empty($this->data))
            extract($this->data);
        if($this->template_path !== null)
            include $this->template_path;
    }

}