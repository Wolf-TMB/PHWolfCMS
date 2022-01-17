<?php

namespace PHWolfCMS;

use PHWolfCMS\Kernel\BaseApp;
use PHWolfCMS\Kernel\ErrorCatcher;

class App extends BaseApp {

    public function __construct() {

        $this->preInit();
    }

    private function preInit() {
        new ErrorCatcher();
        $this->config = new Config();
    }

    public function init(): static {
        $this->db = new Database();

        return $this;
    }

    public function run(): static {
        return $this;
    }
}