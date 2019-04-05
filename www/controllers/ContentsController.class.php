<?php

class ContentsController{

    public function indexAction()
    {
        $content = new Contents();

        $view = new View("pages", "back");
        $view->assign('configFormPage', $content->getFormRegister());
    }
}