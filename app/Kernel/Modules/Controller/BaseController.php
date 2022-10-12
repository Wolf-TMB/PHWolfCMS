<?php

namespace PHWolfCMS\Kernel\Modules\Controller;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Exceptions\CSRFProtectionException;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use PHWolfCMS\Exceptions\RenderFileBlockNotFoundException;
use PHWolfCMS\Exceptions\RenderMaxIterationLimitException;
use PHWolfCMS\Exceptions\RenderFileLayoutNotFoundException;
use PHWolfCMS\Exceptions\RenderFileTemplateNotFoundException;

class BaseController {
    /**
     * Метод создаёт массив данных GET|POST, а также выполняет проверку CSRF-токена
     *
     * @param RequestMethod $type
     * @param bool $verifyCSRFToken
     * @param bool $stripTags
     *
     * @return array
     * @throws CSRFProtectionException
     */
    protected function getRequestData(RequestMethod $type, bool $verifyCSRFToken = true, bool $stripTags = true): array {
        $post = $get = [];
        foreach ($_POST as $key => $value) {
            if ($stripTags) {
                $post[strip_tags(trim($key))] = strip_tags(trim($value));
            } else {
                $post[trim($key)] = trim($value);
            }
        }
        foreach ($_GET as $key => $value) {
            if ($stripTags) {
                $get[strip_tags(trim($key))] = strip_tags(trim($value));
            } else {
                $get[trim($key)] = trim($value);
            }
        }
        $data = match ($type) {
            RequestMethod::POST => $post,
            RequestMethod::GET => $get,
            RequestMethod::ANY => array_merge($post, $get)
        };
        if ($verifyCSRFToken && ($type == RequestMethod::POST || $type == RequestMethod::ANY)) {
            return $this->verifyCSRFToken($data);
        } else {
            return $data;
        }
    }

    /**
     * Проверка CSRF-токена
     * @param $data
     *
     * @return array
     * @throws CSRFProtectionException
     */
    private function verifyCSRFToken(&$data): array {
        global $app;
        if (isset($data['csrf_token'])) {
            if ($app->security->verifyCsrfToken($data['csrf_token'])) {
                unset($data['csrf_token']);
                return $data;
            }
        }
        throw new CSRFProtectionException();
    }

    /**
     * @param string $template Шаблон, который будет отрисован.
     * @param string $layout Слой, который будет использован при отрисовке шаблона
     * @param array $params Переменные, которые будут переданы в шаблон в виде 'var_name' => 'value'. Необязательно, по умолчанию: [].
     * @param string|null $dir Папка для поиска элементов, необходимых для рендера. Необязательно, по умолчанию: null.
     * @param bool $notfound Если истинно, то при отсутствии шаблона будет выдано исключение HttpRouteNotFoundException. Необязательно, по умолчанию: false.
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws HttpRouteNotFoundException
     */
    #[NoReturn] protected function render(string $template, string $layout, array $params = [], string $dir = null, bool $notfound = false) {
        global $app;
        $app->render->renderPage($template, $layout, $params, $dir, $notfound);
    }

    /**
     * Переадресация по URL
     *
     * @param $url
     *
     * @return void
     */
    #[NoReturn] protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
}