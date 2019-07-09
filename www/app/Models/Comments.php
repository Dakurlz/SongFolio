<?php

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\Routing;

class Comments extends BaseSQL
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}