<?php

namespace Songfolio\Controllers;

use Songfolio\Core\Alert;
use Songfolio\Core\View;
use Songfolio\Core\Validator;
use Songfolio\Models\Comments;
use Songfolio\Models\Users;

class CommentsController
{
    private $comment;
    private $user;

    public function __construct(Comments $comment, Users $user)
    {
        $this->comment = $comment;
        $this->user = $user;
        Users::need('comment_perm');
    }

    public function createCommentsAction()
    {

        $redirect =  self::push();
        header('Location: '.BASE_URL.$redirect.'?status=success#comment-section');
    }

    public function listNotConfirmAction()
    {
        $comments = $this->comment->prepareConfirmComments();
        $view = new View('admin/comments/list', 'back');
        $view->assign('comments', $comments);
    }

    public function confirmAction()
    {
        $id = $_REQUEST['id'] ?? '';
        $this->comment->__set('id', $id);
        $this->comment->__set('confirm', 1);
        $this->comment->save();

        self::listNotConfirmAction();
    }

    public function refuseAction()
    {
        $id = $_REQUEST['id'] ?? '';
        $redirect = $_REQUEST['redirect_to'] ?? null;
        if (isset($id)) {
            $this->comment->delete(["id" => $id]);
        }

        if($redirect !== null){
            header('Location: '.BASE_URL.$redirect.'#comment-section');
        }else {
            self::listNotConfirmAction();
        }
    }

    private function push()
    {
        $configForm = [
            "data" => [
                'type' => [
                    "type" => "text",
                    "name" => "type",
                    "required" => true,
                ],
                'type_id' => [
                    "type" => "text",
                    "name" => "type_id",
                    "required" => true,
                ],
                'message' => [
                    "type" => "textarea",
                    "name" => "message",
                    "required" => true,
                    "error" => "Saisissez le massage"
                ],
            ]
        ];

        $data = $_POST;

        $redirect = $_POST['redirect'];
        unset($data['redirect']);

        if (!empty($data)) {
            if ($_SERVER["REQUEST_METHOD"] !== 'POST' || empty($data)) {
                return false;
            }

            $validator = new Validator($configForm, $data);
            $errors = $validator->getErrors();

            if (empty($errors)) {
                isset($_REQUEST['id']) ? $this->comment->__set('id', $_REQUEST['id']) : null;
                $this->comment->__set('type', $data['type']);
                $this->comment->__set('type_id', $data['type_id']);
                $this->comment->__set('user_id', $this->user->__get('id'));
                $this->comment->__set('message', trim($data['message']));

                $this->comment->save();

                return  $redirect;
            } else {

                return Alert::setAlertErrors($errors);
            }
        }
        return false;
    }
}
