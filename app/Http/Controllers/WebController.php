<?php

namespace PHWolfCMS\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Modules\Controller\BaseController;
use PHWolfCMS\Exceptions\RenderFileLayoutNotFoundException;

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

    public function getServers() {
        $this->render(
            'servers',
            'main',
            array(
                'title' => 'Серверы'
            )
        );
    }

    public function getStart() {
        $this->render(
            'start',
            'main',
            array(
                'title' => 'Главная'
            )
        );
    }

    public function getRules() {
        $this->render(
            'rules',
            'main',
            array(
                'title' => 'Правила'
            )
        );
    }

    public function getDonate() {
        $this->render(
            'donate',
            'main',
            array(
                'title' => 'Привелегии'
            )
        );
    }

    public function getVote() {
        $this->render(
            'vote',
            'main',
            array(
                'title' => 'Голосуй'
            )
        );
    }

    /**
     * @throws RenderFileLayoutNotFoundException
     */
    #[NoReturn] public function getCabinet() {
        $this->render(
            'cabinet',
            'main',
            array(
                'title' => 'Личный кабинет'
            )
        );
    }

    public function getSettings() {
        $this->render(
            'settings',
            'main',
            array(
                'title' => 'Настройки аккаунта'
            )
        );
    }
}