<?php

namespace PHWolfCMS;

use Dotenv\Dotenv;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;

class Config {
    private array $variables;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
        foreach ($_ENV as $key => $value) {
            $this->variables[$key] = $value;
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