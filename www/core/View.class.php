<?php

class View{

    private $v;
    private $t;

    public function __construct($v, $t="back"){
        $this->setView($v);
        $this->setTemplate($t);
    }

    public function setView($v){
        $vPath = "views/".$v.".view.php";
        if(file_exists($vPath)) {
            $this->v = $vPath;
        }else{
            die("Le template n'existe pas ". $vPath);
        }
    }

    public function setTemplate($t){
        $tPath = "views/templates/".$t.".tpl.php";
        if(file_exists($tPath)) {
            $this->t = $tPath;
        }else{
            die("Le template n'existe pas ". $tPath);
        }
    }

    public function addModal($modal, $config){
        $mPath = "views/modals/".$modal.".mod.php";
        if(file_exists($mPath)) {
            include $mPath;
        }else{
            die("Le modal n'existe pas ". $mPath);
        }
    }

    public function assign($key, $value){
        $this->data[$key]=$value;
    }

    public function __destruct(){
        if(!empty($this->data))
            extract($this->data);
        include $this->t;
    }

}