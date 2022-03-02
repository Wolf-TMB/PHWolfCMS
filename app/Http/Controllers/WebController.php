<?php

namespace PHWolfCMS\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;
use PHWolfCMS\Kernel\Modules\Controller\BaseController;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use PHWolfCMS\Exceptions\RenderMaxIterationLimitException;
use PHWolfCMS\Exceptions\RenderFileBlockNotFoundException;
use PHWolfCMS\Exceptions\RenderFileLayoutNotFoundException;
use PHWolfCMS\Exceptions\RenderFileTemplateNotFoundException;

class WebController extends BaseController {
    /**
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
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
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
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
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
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
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
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
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
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
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
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
     * @throws RenderMaxIterationLimitException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderFileLayoutNotFoundException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
     */
    #[NoReturn] public function getCabinet() {
        $this->render(
            template: 'cabinet',
            layout: 'main',
            params: array(
                'title' => 'Личный кабинет'
            )
        );
    }

    /**
     * @throws RenderMaxIterationLimitException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderFileLayoutNotFoundException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
     */
    #[NoReturn] public function getSettings() {
        $this->render(
            template: 'settings',
            layout: 'main',
            params: array(
                'title' => 'Настройки аккаунта'
            )
        );
    }
}