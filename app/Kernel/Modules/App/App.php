<?php

namespace PHWolfCMS\Kernel\Modules\App;

use PHWolfCMS\Kernel\Modules\Html\Html;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Kernel\Modules\Router\Router;
use PHWolfCMS\Kernel\Modules\Render\Render;
use PHWolfCMS\Kernel\Modules\Session\Session;
use PHWolfCMS\Kernel\Modules\Database\Database;
use PHWolfCMS\Kernel\Modules\Security\Security;

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

        $this->html = new Html();

        return $this;
    }

    public function run(): static {
        $this->router->run();
        return $this;
    }
}