<?php

namespace PHWolfCMS\Kernel\Modules\Router;

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\NotEnoughRightsException;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use PHWolfCMS\Exceptions\RenderFileBlockNotFoundException;
use PHWolfCMS\Exceptions\RenderMaxIterationLimitException;
use PHWolfCMS\Exceptions\RenderFileLayoutNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use PHWolfCMS\Exceptions\RenderFileTemplateNotFoundException;
use PHWolfCMS\Exceptions\PermissionsAllowedOnlyForControllerHandlerException;

class Router {

    private RouteCollector $router;
	private Config $config;

    public function __construct() {
		$this->config = new Config('module', 'router');
        $this->router = new RouteCollector();
    }

    /**
     * @param string $url URL, на который необходимо совершить переадресацию
     */
    public function redirect(string $url) {
        header('Location: ' . $url);
    }

    /**
     * @throws PermissionsAllowedOnlyForControllerHandlerException
     */
    public function get($route, $handler, $filters = [], $permissions = []) {
        if (!empty($permissions)) {
            if (gettype($handler) != 'array') throw new PermissionsAllowedOnlyForControllerHandlerException();
            global $app;
            $app->permissionsManager->getPagePermissionsManager()->add($handler['0'].'::'.$handler[1], $permissions);
        }
        $this->router->get($route, $handler, $filters);
    }

    /**
     * @throws PermissionsAllowedOnlyForControllerHandlerException
     */
    public function post($route, $handler, $filters = [], $permissions = []) {
        if (!empty($permissions)) {
            if (gettype($handler) != 'array') throw new PermissionsAllowedOnlyForControllerHandlerException();
            global $app;
            $app->permissionsManager->getPagePermissionsManager()->add($handler['0'].'::'.$handler[1], $permissions);
        }
        $this->router->post($route, $handler, $filters);
    }

    public function filter($name, $handler) {
        $this->router->filter($name, $handler);
    }

    public function group($filters, $handler) {
        $this->router->group($filters, $handler);
    }

    public function route($name, array $args = null): string {
        return '/' . $this->router->route($name, $args);
    }

	/**
	 * @throws ConfigKeyNotFoundException
	 */
	private function loadRouterFiles() {
        global $app;
        $files = $this->searchFiles($app->rootDir . $this->config->get('ROUTES_DIR'), $this->config->get('ROUTES_DIR'));
        $files = $this->prepareFileArrayToLoad($files);
        $URIData = explode('/', rtrim(ltrim($app->requestURI,'/'), '/'));
        if (key_exists($URIData[0], $files)) {
            foreach ($files[$URIData[0]] as $file) {
                require_once $file;
            }
        } else {
            foreach ($files['web'] as $file) {
                require_once $file;
            }
        }
    }

    private function searchFiles($path, $dir, &$files = []): array {
        $_files = scandir($path);
        foreach ($_files as $file) {
            if ($file == '.' || $file == '..') continue;
            $item = $path . '/' . $file;
            if (is_dir($item)) {
                $this->searchFiles($item, $dir .'/'. $file, $files);
            } else {
                $files[] = $item;
            }
        }
        return $files;
    }

    private function prepareFileArrayToLoad($files): array {
        global $app;
        $_files = $files;
        $files = [];
        $rmlen = strlen($app->rootDir) + strlen($this->config->get('ROUTES_DIR')) + 1;
        foreach ($_files as $key => $file) {
            $fileData = explode('/', substr($file, $rmlen));
            if (count($fileData) > 1) {
                $files[$fileData[0]][] = $file;
            } else {
                $files['web'][] = $file;
            }
        }
        return $files;
    }

	/**
	 * @throws RenderMaxIterationLimitException
	 * @throws RenderFileLayoutNotFoundException
	 * @throws HttpRouteNotFoundException
	 * @throws RenderFileTemplateNotFoundException
	 * @throws ConfigKeyNotFoundException
	 * @throws RenderFileBlockNotFoundException
	 */
	public function run() {
        global $app;
        $this->loadRouterFiles();
        $dispatcher = new Dispatcher($this->router->getData());

        $URIData = explode('/', rtrim(ltrim($app->requestURI,'/'), '/'));
        try {
            if (
                $app
                    ->permissionsManager
                    ->getPagePermissionsManager()
                    ->checkPermissionsForPage(
                        $dispatcher
                            ->getHandler(
                                $_SERVER['REQUEST_METHOD'],
                                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                            )
                    )
            ) {
                $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                echo $response;
            } else {
                throw new NotEnoughRightsException();
            }
        } catch (HttpRouteNotFoundException) {
            if ($URIData[0] == $this->config->get('ROUTER_API_PREFIX')) {
                header("HTTP/1.0 404 Not Found");
                die();
            }
            $app->render->renderPage(
                '404',
                'main',
                array(
                    'title' => 404
                )
            );
        } catch (HttpMethodNotAllowedException) {
            if ($URIData[0] == $this->config->get('ROUTER_API_PREFIX')) {
                http_send_status(403);
                die(403);
            }
            $app->render->renderPage(
                '404',
                'main',
                array(
                    'title' => 404
                )
            );
        } catch (NotEnoughRightsException) {
            die('Permissions denied');
        }
    }
}