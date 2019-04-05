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
        $user = new User();
        
        $v = new View("user", "_back");
        $v->assign('allUsers', $user->getAllData());
    }

    public function loadPagesAction(){
        $v = new View("pages", "_back");
    }

    public function loadAlbumAction(){
        $v = new View("album", "_back");
    }
}