<?php

namespace PHWolfCMS\Kernel;

use PHWolfCMS\Kernel\Enums\RequestMethod;

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
}