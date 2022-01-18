<?php

namespace PHWolfCMS;

use PHWolfCMS\Kernel\Router;
use PHWolfCMS\Kernel\BaseApp;
use PHWolfCMS\Kernel\ErrorCatcher;

class App extends BaseApp {

    public function __construct() {
        $this->rootDir = $_SERVER['DOCUMENT_ROOT'] . '/';
        $this->preInit();
    }

    private function preInit() {
        new ErrorCatcher();
        $this->config = new Config();
    }

    public function init(): static {
        $this->db = new Database();
        $this->router = new Router();

        return $this;
    }

    public function run(): static {
        $this->router->run();
        return $this;
    }
}