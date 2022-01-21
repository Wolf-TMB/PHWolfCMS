<?php

namespace PHWolfCMS;

use PHWolfCMS\Kernel\Router;
use PHWolfCMS\Kernel\Render;
use PHWolfCMS\Kernel\Config;
use PHWolfCMS\Kernel\BaseApp;
use PHWolfCMS\Kernel\Session;
use PHWolfCMS\Kernel\Security;
use PHWolfCMS\Kernel\Database;
use PHWolfCMS\Kernel\ErrorCatcher;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

class App extends BaseApp {

    public function __construct() {
        $this->rootDir = $_SERVER['DOCUMENT_ROOT'] . '/';
        $this->requestURI = $_SERVER['REQUEST_URI'];
        if ($_SERVER['REQUEST_METHOD'] == 'GET') $this->requestMethod = RequestMethod::GET;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') $this->requestMethod = RequestMethod::POST;
    }

    public function preInit(): static {
        new ErrorCatcher();
        $this->config = new Config();

        return $this;
    }

    public function init(): static {
        ob_start();

        $this->db = new Database();
        $this->session = new Session();
        $this->security = new Security();
        $this->router = new Router();
        $this->render = new Render();

        return $this;
    }

    public function run(): static {
        $this->router->run();
        return $this;
    }
}