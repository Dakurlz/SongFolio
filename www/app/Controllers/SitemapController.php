<?php

namespace Songfolio\Controllers;

use Songfolio\Core\BaseSQL;
use Songfolio\Core\View;
use Songfolio\Core\Helper;
use Songfolio\Core\Routing;

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
        $allData = array_merge($allData, $this->getPublicRoutes());
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

    public function getPublicRoutes()
    {
        $routes = Routing::getRoutes();
        $urls = [];
        foreach ($routes as $key => $value) {
            if (isset($value['needAuth']) ? !$value['needAuth'] : false) $urls[] = substr($key, 1);
        }
        return $urls;
    }
}
