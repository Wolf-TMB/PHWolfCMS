<?php

namespace PHWolfCMS\Kernel\Modules\Config;

use Dotenv\Dotenv;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;

class Config {
    private array $variables;

	/**
     * Если первым аргументом передано "app", то загружается конфигурация приложения,
     * если передано "module", то вторым аргументом указывается имя модуля, для
     * которого следует загрузить конфигурацию
     *
     * @param string $type
     * @param string $moduleName
     *
	 * @throws ConfigKeyNotFoundException
	 */
	public function __construct(string $type = 'app', string $moduleName = '') {
        global $app;
        if ($type == 'app') {
	        $dotenv = Dotenv::createImmutable($app->rootDir);
	        $dotenv->load();
	        foreach ($_ENV as $key => $value) {
		        $this->variables[$key] = $value;
	        }
        } else if ($type == 'module') {
			$filename = $app->rootDir . '/' . $app->config->get('CONFIG_FILE_DIR') . '/' . $moduleName . '.config.php';
			$this->variables = require $filename;
        }
    }

    /**
     * Попытка получить значение конфигурации по ключу
     *
     * @param string $key
     *
     * @return mixed
     * @throws ConfigKeyNotFoundException
     */
    public function get(string $key): mixed {
        if (key_exists($key, $this->variables)) {
            return $this->variables[$key];
        } else {
            throw new ConfigKeyNotFoundException("Config key \"<strong>$key</strong>\" not found!");
        }
    }
}