<?php

class AdminController{

    public function defaultAction()
    {
        $v = new View("dashboard", "_back");
    }

    public function loadAuthAction(){
        $v = new View("loginAdmin", '_main');
    }

    public function loadUserAction(){
        
      $v = new View("user", "_back");
    }
}