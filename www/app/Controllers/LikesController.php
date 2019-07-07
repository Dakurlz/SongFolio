<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Models\Likes;

class LikesController
{
    private $like;

    public function __construct(Likes $like)
    {
        $this->like = $like;
    }
    public function addLikeAction()
    {
        // echo 'qsdqsdqsdqsd';
        $data = $_POST;
        $where = ['user_id' => $data['user_id'], 'type' => $data['type'], 'type_id' => $data['type_id']];

        $check = $this->like->getAllBy($where);
        if (empty($check)) {
            $this->like->__set('type_id', $data['type_id']);
            $this->like->__set('type', $data['type']);
            $this->like->__set('user_id', $data['user_id']);
            $this->like->save();
            echo 'add';

        } else {
            $this->like->delete($where);
            echo 'remove';
        }

    
    }
}
