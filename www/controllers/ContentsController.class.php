<?php
declare (strict_types = 1);

class ContentsController
{

    public function createContentsAction(): void
    {
        $content = new Contents();
        $configForm = $content->getFormRegister();
        $method = strtoupper($configForm["config"]["method"]);
        $data = $GLOBALS["_" . $method];


        if (!empty($data)) {
            // $validator = new Validator($configForm, $data);


            $fileName = Helper::uploadImage('public/uploads/contents/');

            $content->__set('type', $data['type']);
            $content->__set('slug', $data['slug']);
            $content->__set('title', $data['title']);
            $content->__set('description', $data['description']);
            $content->__set('content', $data['content']);
            $content->__set('header', " "); // ?????????
            $content->__set('author', 1); // ?????????
            $content->__set('img_dir', $fileName);
            $content->save();

            var_dump($content); 

        }

        $view = new View("admin/create_pages", "back");
        $view->assign('configFormPage', $configForm);
    }
}
