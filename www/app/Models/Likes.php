<?php

declare(strict_types=1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;

class Likes extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function getNbLikeByTypeAndId($type, $type_id): int
    {
        return count($this->getAllBy(['type' => $type, 'type_id' => $type_id]));
    }

    public static function checkIfUserLiked(array $likes, string $type_id, string $user_id)
    {

        foreach ($likes as $like) {
            if ($like['type_id'] == $type_id && $like['user_id'] == $user_id) {
                return true;
                break;
            }
        }

        return false;
    }

    public static function displayLike(array $likes, string $type_id)
    {
        $nbr = 0;
        foreach ($likes as $like) {
            if ($like['type_id'] == $type_id) {
                $nbr++;
            }
        }
        return $nbr;
    }
}
