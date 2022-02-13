<?php

namespace PHWolfCMS\Kernel;

use Dotenv\Dotenv;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;

class Config {
    private array $variables;

	/**
	 * @throws ConfigKeyNotFoundException
	 */
	public function __construct($type = 'app', $moduleName = '') {
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
     * @throws ConfigKeyNotFoundException
     */
    public function get(string $key) {
        if (key_exists($key, $this->variables)) {
            return $this->variables[$key];
        } else {
            throw new ConfigKeyNotFoundException("Config key \"<strong>$key</strong>\" not found!");
        }
    }
}