<?php

namespace app\Models;

use app\Core\BaseSQL;
use app\Core\Routing;

class Comments extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}