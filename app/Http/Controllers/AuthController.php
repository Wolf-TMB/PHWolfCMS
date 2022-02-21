<?php

namespace PHWolfCMS\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Controller\BaseController;

class AuthController extends BaseController {
    #[NoReturn] public function getLogin() {
        $this->render(
            'login',
            'main',
            array(
                'title' => 'Аутентификация'
            )
        );
    }

    public function postLogin() {
        echo '<pre>';
            print_r($this->getRequestData(RequestMethod::POST));
        echo '</pre>';
    }

    #[NoReturn] public function getRegister() {
        $this->render(
            'register',
            'main',
            array(
                'title' => 'Регистрация'
            )
        );
    }

    public function postRegister() {
        echo '<pre>';
            print_r($this->getRequestData(RequestMethod::POST));
        echo '</pre>';
    }
}