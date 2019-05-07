<?php

declare (strict_types = 1);

namespace Songfolio\Models;

use Songfolio\Core\BaseSQL;

class Settings extends BaseSQL
{

    public function __construct($id = null)
    {
        if (!isset($id) && isset($_SESSION['user'])) {
            $id = $_SESSION['user'];
        }
        parent::__construct($id);
    }
}
