<?php

namespace Songfolio\Controllers;

use Songfolio\Core\View;
use Songfolio\Core\Validator;
use Songfolio\Core\Helper;
use Songfolio\Models\Categories;
use Songfolio\Models\Events;

class EventsController
{
    private $event;

    public function __construct(Events  $event)
    {
        $this->event = $event;
    }
}