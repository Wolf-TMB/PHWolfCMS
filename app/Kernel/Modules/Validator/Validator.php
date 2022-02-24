<?php

namespace PHWolfCMS\Kernel\Modules\Validator;

use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\ValidatorNotFoundException;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;

class Validator {
    private Config $config;
    public function __construct() {
        $this->config = new Config('module', 'validator');
    }

    /**
     * @throws ValidatorNotFoundException
     * @throws ConfigKeyNotFoundException
     */
    public function getValidator($validator) {
        $validators = $this->config->get('validators');
        if (!property_exists($validators, $validator)) throw new ValidatorNotFoundException();
        return new $validators->{$validator}->class($validators->{$validator});
    }
}