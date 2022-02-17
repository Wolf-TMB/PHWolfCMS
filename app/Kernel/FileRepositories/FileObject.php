<?php

namespace PHWolfCMS\Kernel\FileRepositories;

use PHWolfCMS\Kernel\Config;

class FileObject {
    private Config $config;

    private int $id;
    private string $repositoryName;
    private object $repository;
    private string $name;
    private string $path;
    private string $ext;
    private string $size;
    private string $hash;
    private string $deleted;
    public string $created_at;
    public string $updated_at;

    public function __construct($data) {
        $this->config = new Config('module', 'file_repository');

        $this->id = $data->id;
        $this->repositoryName = $data->repository;
        $this->name = $data->name;
        $this->path = $data->path;
        $this->ext = $data->ext;
        $this->size = $data->size;
        $this->hash = $data->hash;
        $this->deleted = $data->deleted;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;

        $this->repository = new ($this->config->get('repositories')->{$this->repositoryName})($this->repositoryName);
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string {
        return $this->repositoryName;
    }

    /**
     * @return object
     */
    public function getRepository(): object {
        return $this->repository;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getExt(): string {
        return $this->ext;
    }

    /**
     * @return string
     */
    public function getSize(): string {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getHash(): string {
        return $this->hash;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool {
        return ($this->deleted == 1);
    }
}