<?php

namespace PHWolfCMS\Http\Controllers;

use PHWolfCMS\Kernel\BaseController;
use PHWolfCMS\Kernel\Enums\RequestMethod;

class TestController extends BaseController {
    public function getIndex() {
        $this->render(
            'test1',
            'main',
            array(
                'title' => 'test'
            )
        );
    }

    public function postIndex() {
        echo '<pre>';
            print_r($this->getRequestData(RequestMethod::ANY));
        echo '</pre>';
    }
}