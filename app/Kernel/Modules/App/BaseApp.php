<?php

namespace PHWolfCMS\Kernel\Modules\App;

use PHWolfCMS\Models\User;
use PHWolfCMS\Kernel\Modules\Html\Html;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Kernel\Modules\Router\Router;
use PHWolfCMS\Kernel\Modules\Render\Render;
use PHWolfCMS\Kernel\Modules\Session\Session;
use PHWolfCMS\Kernel\Modules\Database\Database;
use PHWolfCMS\Kernel\Modules\Security\Security;

class BaseApp {
    public string $rootDir;
    public string $requestURI;
    public RequestMethod $requestMethod;
    public Config $config;
    public Session $session;
    public Security $security;
    public Database $db;
    public Router $router;
    public Render $render;
    public Html $html;

    public User|false $user;

    public function refreshUserData() {
        if ($this->session->get('userid') !== false) {
            $this->user = new User($this->session->get('userid'));
        } else {
            $this->user = false;
        }
    }
}