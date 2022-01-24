<?php

namespace PHWolfCMS\Kernel;

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

class Router {

    private RouteCollector $router;

    public function __construct() {
        $this->router = new RouteCollector();
    }

    /**
     * @param string $url URL, на который необходимо совершить переадресацию
     */
    public static function redirect(string $url) {
        header('Location: ' . $url);
    }

    public function get($route, $handler, $filters = []) {
        $this->router->get($route, $handler, $filters);
    }

    public function post($route, $handler, $filters = []) {
        $this->router->post($route, $handler, $filters);
    }

    public function filter($name, $handler) {
        $this->router->filter($name, $handler);
    }

    public function group($filters, $handler) {
        $this->router->group($filters, $handler);
    }

    private function loadRouterFiles() {
        global $app;
        $files = $this->searchFiles($app->rootDir . $app->config->get('ROUTES_DIR'), $app->config->get('ROUTES_DIR'));
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

    private function searchFiles($path, $dir, &$files = []) {
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
        $rmlen = strlen($app->rootDir) + strlen($app->config->get('ROUTES_DIR')) + 1;
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

    public function run() {
        global $app;
        $this->loadRouterFiles();
        $dispatcher = new Dispatcher($this->router->getData());
        $URIData = explode('/', rtrim(ltrim($app->requestURI,'/'), '/'));
        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            echo $response;
        } catch (HttpRouteNotFoundException) {
            if ($URIData[0] == $app->config->get('ROUTER_API_PREFIX')) {
                http_send_status(404);
                die(404);
            }
            $app->render->renderPage(
                '404',
                'main',
                array(
                    'title' => 404
                )
            );
        } catch (HttpMethodNotAllowedException) {
            if ($URIData[0] == $app->config->get('ROUTER_API_PREFIX')) {
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
        }
    }
}