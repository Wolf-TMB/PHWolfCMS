<?php

namespace PHWolfCMS\Kernel;

class BaseApp {
    public string $rootDir;
    public string $requestURI;
    public Config $config;
    public Session $session;
    public Security $security;
    public Database $db;
    public Router $router;
    public Render $render;
}