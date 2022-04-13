<?php

namespace PHWolfCMS\Kernel\Modules\App;

use PHWolfCMS\Kernel\Modules\Html\Html;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Kernel\Modules\Logger\Logger;
use PHWolfCMS\Kernel\Modules\Router\Router;
use PHWolfCMS\Kernel\Modules\Render\Render;
use PHWolfCMS\Kernel\Modules\Session\Session;
use PHWolfCMS\Kernel\Modules\Database\Database;
use PHWolfCMS\Kernel\Modules\Security\Security;
use PHWolfCMS\Kernel\Modules\Validator\Validator;
use PHWolfCMS\Kernel\Modules\FileRepository\FileRepository;
use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use PHWolfCMS\Kernel\Modules\PermissionManager\PermissionsManager;

class App extends BaseApp {
    /**
     * Заполняются свойства объекта
     */
    public function __construct() {
        $this->rootDir = $_SERVER['DOCUMENT_ROOT'] . '/';
        $this->requestURI = $_SERVER['REQUEST_URI'];
        $this->refer = @$_SERVER['HTTP_REFERER'];
        if ($_SERVER['REQUEST_METHOD'] == 'GET') $this->requestMethod = RequestMethod::GET;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') $this->requestMethod = RequestMethod::POST;
    }

    /**
     * Загружается конфигурация и запускается перехватчик ошибок
     * @return $this
     */
    public function preInit(): static {
        new ErrorCatcher();
        $this->config = new Config();

        return $this;
    }

    /**
     * Подгружаются все модули
     * @return $this
     */
    public function init(): static {
        ob_start();

        $this->db = new Database();
        $this->session = new Session();
        $this->security = new Security();
        $this->router = new Router();
        $this->render = new Render();

        $this->validator = new Validator();
        $this->fileRepository = new FileRepository();
	    $this->googleAuthenticator = new GoogleAuthenticator(6, 25);
	    $this->logger = new Logger();
        $this->permissionsManager = new PermissionsManager();

        return $this;
    }

    /**
     * Запускается маршрутизатор, обновляются пользовательские данные и выполняются другие действия, которые должны быть выполнены после загрузки всех модулей
     * @return static
     * @throws
     */
    public function run(): static {
        $this->refreshUserData();
        $this->router->run();
        return $this;
    }
}