<?php

namespace PHWolfCMS\Kernel\Modules\FileRepository;

use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;
use PHWolfCMS\Exceptions\ValidatorNotFoundException;
use PHWolfCMS\Kernel\Modules\Validator\BaseValidator;
use PHWolfCMS\Exceptions\FileRepositoryNotFoundException;

class FileRepository {
    /**
     * @var Config
     */
    private Config $config;

    public function __construct() {
        $this->config = new Config('module', 'file_repository');
    }


    /**
     * @param $repository
     *
     * @return FileRepositoryBase
     * @throws ConfigKeyNotFoundException
     * @throws FileRepositoryNotFoundException
     */
    public function get($repository): FileRepositoryBase {
        $repositories = $this->config->get('repositories');
        if (!property_exists($repositories, $repository)) throw new FileRepositoryNotFoundException();
        return new $repositories->{$repository}->class($repository);
    }
}