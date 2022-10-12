<?php

namespace PHWolfCMS\Kernel\Modules\Validator;

use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\ValidatorMethodNotFoundException;

class BaseValidator {
    protected object $config;

    public function __construct(object $config) {
        $this->config = $config;
    }

    /**
     * Переопределите данный метод в дочернем классе, если требуется функционал, который не реализован
     * @param mixed $param
     * @param array $options
     *
     * @return bool
     * @throws ValidatorMethodNotFoundException
     */
    public function validate(mixed $param, array $options = []): bool {
        $return = true;
        foreach ($this->config->validators as $method => $value) {
            if (!method_exists($this, $method)) throw new ValidatorMethodNotFoundException('Method ' . $method . ' not found!');
            if (!$this->{$method}($param, $value)) $return = false;
        }
        return $return;
    }

    /**
     * Проверка строки паттерну email
     *
     * @param $string
     * @param $param
     *
     * @return bool
     */
    protected function email($string, $param): bool {
        return filter_var($string, FILTER_VALIDATE_EMAIL) == $param;
    }

    /**
     * Проверка длины строки (>=)
     * @param $string
     * @param $length
     *
     * @return bool
     */
    protected function min_length($string, $length): bool {
        return (strlen($string) >= $length);
    }

    /**
     * Проверка длины строки (<)
     * @param $string
     * @param $length
     *
     * @return bool
     */
    protected function max_length($string, $length): bool {
        return (strlen($string) < $length);
    }

    /**
     * Проверка длины строки (=)
     * @param $string
     * @param $length
     *
     * @return bool
     */
    protected function length($string, $length): bool {
        return (strlen($string) == $length);
    }

    /**
     * Проверка строки по регулярному выражению
     * @param $string
     * @param $regexp
     *
     * @return bool
     */
    protected function regexp($string, $regexp): bool {
        return preg_match($regexp, $string);
    }
}