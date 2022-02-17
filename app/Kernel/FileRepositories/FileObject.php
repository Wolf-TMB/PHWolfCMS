<?php

namespace PHWolfCMS\Kernel\FileRepositories;

use PHWolfCMS\Kernel\Config;

class FileObject {
    private Config $config;

    private ?int $id;
    private int $owner;
    private string $repositoryName;
    private object $repository;
    private string $name;
    private string $file;
    private string $path;
    private string $ext;
    private string $size;
    private string $hash;
    private string $deleted;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct($data) {
        $this->config = new Config('module', 'file_repository');

        $this->id = @$data->id;
        $this->owner = $data->owner;
        $this->repositoryName = $data->repository;
        $this->name = $data->name;
        $this->file = $data->file;
        $this->path = $data->path;
        $this->ext = $data->ext;
        $this->size = $data->size;
        $this->hash = $data->hash;
        $this->deleted = $data->deleted;
        $this->created_at = @$data->created_at;
        $this->updated_at = @$data->updated_at;

        $this->repository = new ($this->config->get('repositories')->{$this->repositoryName}->class)($this->repositoryName);
    }

    public function save() {
        global $app;
        $params = array(
            'owner' => $this->owner,
            'repository' => $this->repositoryName,
            'name' => $this->name,
            'file' => $this->file,
            'path' => $this->path,
            'ext' => $this->ext,
            'size' => $this->size,
            'hash' => $this->hash,
            'deleted' => $this->deleted
        );
        if ($this->id) {
            $app->db->update(
                'UPDATE files SET owner = :owner, repository = :repository, name = :name, file = :file, path = :path, ext = :ext, size = :size, hash = :hash, deleted = :deleted WHERE id = :id',
                array_merge($params, ['id' => $this->id])
            );
        } else {
            $app->db->insert('files', $params);
        }
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOwnerID(): int {
        return $this->owner;
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
    public function getFilename(): string {
        return $this->file;
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