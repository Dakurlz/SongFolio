<?php

declare (strict_types = 1);
namespace app\Models;
use app\Core\BaseSQL;

class Menus extends BaseSQL
{

    public function __construct($id = null)
    {
        if (!isset($id) && isset($_SESSION['user'])) {
            $id = $_SESSION['user'];
        }
        parent::__construct($id);
    }

    public function customSet($attr, $value)
    {
        switch ($attr) {
            case 'data':
                if (is_array($value)) {
                    return json_encode($value);
                }
                break;
        }

        return $value;
    }

    public function customGet($attr, $value)
    {
        switch ($attr) {
            case 'data':
                return json_decode($value, true);
                break;
        }

        return $value;
    }

    public function show($as)
    {
        switch ($as) {
            case 'menu_edit':
                return $this->show_menu_edit($this->__get('data'));
                break;
        }
    }

    public function show_menu_edit($linklist)
    {
        $result = '';

        foreach ($linklist as $link) {
            $result .= '<li><div class="block block-title" link="' . $link['link'] . '">' . $link['title'] . '</div><ul class="sortable list-unstyled">';

            if (isset($link['children'])) {
                $result .= $this->show_menu_edit($link['children']);
            }

            $result .= '</ul></li>';
        }

        return $result;
    }
}
