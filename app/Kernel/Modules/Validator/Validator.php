<?php

namespace PHWolfCMS\Kernel\Modules\Validator;

use stdClass;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\ValidatorNotFoundException;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;

class Validator {
    /**
     * @var Config
     */
    private Config $config;

    public function __construct() {
        $this->config = new Config('module', 'validator');
    }


    /**
     * @param $validator
     *
     * @return BaseValidator
     * @throws ConfigKeyNotFoundException
     * @throws ValidatorNotFoundException
     */
    public function get($validator): BaseValidator {
        $validators = $this->config->get('validators');
        if (!property_exists($validators, $validator)) throw new ValidatorNotFoundException();
        return new BaseValidator($validators->{$validator});
    }
}