<?php

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;
use Songfolio\Models\Users;

class Comments extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function prepareComments(string $type, string $id ): array
    {
        $comments = $this->getAllBy(['type'=> $type, 'type_id' => $id, 'confirm'=>'1']);
        return self::match($comments);
    }

    public function prepareConfirmComments(string $type, string $id)
    {
        $comments = $this->getAllBy(['type'=> $type, 'type_id' => $id, 'confirm'=>'0']);
        return self::match($comments);
    }

    private function match($comments): array
    {
        foreach ($comments as $key => $value) {
            $user = new Users($value['user_id']);
            $comments[$key]['user_name'] = ($user->__get('first_name') === null || $user->__get('first_name') === '') ? $user->__get('username') : $user->getFullName(); 
        }
        return $comments;
    }


}
