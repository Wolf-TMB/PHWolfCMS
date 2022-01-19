<?php

namespace PHWolfCMS\Kernel;

use PHWolfCMS\Config;
use PHWolfCMS\Database;

class BaseApp {
    public string $rootDir;
    public string $requestURI;
    public Config $config;
    public Session $session;
    public Database $db;
    public Router $router;
    public Render $render;
}