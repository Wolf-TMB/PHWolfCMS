<?php

namespace PHWolfCMS\Kernel\Modules\App;

use Google\Authenticator\GoogleAuthenticator;
use PHWolfCMS\Kernel\Modules\Logger\Logger;
use PHWolfCMS\Models\User;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Kernel\Modules\Router\Router;
use PHWolfCMS\Kernel\Modules\Render\Render;
use PHWolfCMS\Kernel\Modules\Session\Session;
use PHWolfCMS\Kernel\Modules\Database\Database;
use PHWolfCMS\Kernel\Modules\Security\Security;
use PHWolfCMS\Kernel\Modules\Validator\Validator;
use PHWolfCMS\Kernel\Modules\FileRepository\FileRepository;
use PHWolfCMS\Kernel\Modules\PermissionManager\PermissionsManager;

class BaseApp {
    public string $rootDir;
    public string $requestURI;
    public ?string $refer;
    public RequestMethod $requestMethod;
    public Config $config;
    public Session $session;
    public Security $security;
    public Database $db;
    public Router $router;
    public Render $render;
    public Validator $validator;
    public FileRepository $fileRepository;
    public GoogleAuthenticator $googleAuthenticator;
    public Logger $logger;
    public PermissionsManager $permissionsManager;

    public User|false $user;

    /**
     * Обновляются данные аутентифицированного пользователя
     * @return void
     */
    public function refreshUserData() {
        if ($this->session->get('userid') !== false) {
            $this->user = User::find(array(
                ['id', '=', $this->session->get('userid')]
            ));
        } else {
            $this->user = false;
        }
    }
}