<?php

namespace PHWolfCMS\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Modules\Controller\BaseController;

class WebController extends BaseController {
    /**
     * @throws
     */
    #[NoReturn] public function getIndex() {
        $this->render(
            template: 'index',
            layout: 'main',
            params: array(
                'title' => 'Главная'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getServers() {
        $this->render(
            template: 'servers',
            layout: 'main',
            params: array(
                'title' => 'Серверы'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getStart() {
        $this->render(
            template: 'start',
            layout: 'main',
            params: array(
                'title' => 'Главная'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getRules() {
        $this->render(
            template: 'rules',
            layout: 'main',
            params: array(
                'title' => 'Правила'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getDonate() {
        $this->render(
            template: 'donate',
            layout: 'main',
            params: array(
                'title' => 'Привилегии'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getVote() {
        $this->render(
            template: 'vote',
            layout: 'main',
            params: array(
                'title' => 'Голосуй'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getSkyblock() {
        $this->render(
            template: 'skyblock',
            layout: 'main',
            params: array(
                'title' => 'SkyBlock 1.7.10'
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getCabinet() {
        global $app;
        $this->render(
            template: 'cabinet.cabinet',
            layout: 'main',
            params: array(
                'title' => 'Личный кабинет',
                'user' => $app->user
            )
        );
    }

    /**
     * @throws
     */
    #[NoReturn] public function getSettings() {
        $this->render(
            template: 'cabinet.settings',
            layout: 'main',
            params: array(
                'title' => 'Настройки аккаунта'
            )
        );
    }
}