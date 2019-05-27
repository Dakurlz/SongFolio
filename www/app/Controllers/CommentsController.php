<?php

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Validator;
use Songfolio\Core\Helper;
use Songfolio\Models\Comments;

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