<?php

namespace PHWolfCMS\Http\Controllers;

use PHWolfCMS\Kernel\BaseController;

class WebController extends BaseController {
    public function getIndex() {
        $this->render(
            'index',
            'main',
            array(
                'title' => 'Главная'
            )
        );
    }
}