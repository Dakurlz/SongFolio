<?php

namespace app\Controllers;

use app\Core\View;
use app\Core\Validator;
use app\Core\Helper;
use app\Models\Comments;

class CommentsController
{
    private $comment;

    public function __construct(Comments $comment)
    {
        $this->comment = $comment;
    }

    public function createCommentAction()
    {

    }

    public function listNotConfirmAction()
    {
        $comments = $this->comment->getAllBy(['confirm'=> 0]);
        $view = new View('admin/comments/list','back');
        $view->assign('comments', $comments);
    }
}