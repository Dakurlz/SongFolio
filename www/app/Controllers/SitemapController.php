<?php

namespace Songfolio\Controllers;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\View;

class SitemapController extends BaseSQL
{


    public function defaultAction()
    {
        $tables = ['Albums', 'Contents', 'Events', 'Songs'];

        $allData = [];

        foreach ($tables as $tab) {
            $data = $this->getCustomWithoutWhere('SELECT slug FROM ' . $tab);
            $result = $this->prepareData($data);
            $allData = array_merge($allData, $result);
        }
        $view = new View('sitemap', 'xml');
        $view->assign('data', $allData);
    }

    public function prepareData($result)
    {
        $data = [];

        foreach ($result as $r) {
            foreach ($r as $key => $value) {
                $data[] = $value;
            }
        }
        return $data;

    }
}
