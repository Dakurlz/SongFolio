<?php

class PagesController{

    public function defaultAction(){

        $pseudo = "Jean";

        $v = new View("home");
        $v->assign("pseudo", $pseudo);
    }
}