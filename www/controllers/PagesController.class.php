<?php

class PagesController{

    public function indexAction()
    {
        $page = new Pages();

        $view = new View("pages", "_back");
        $view->assign('configFormPage', $page->getFormRegister());
    }
}