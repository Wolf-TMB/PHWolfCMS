<?php

namespace PHWolfCMS\Kernel\FileRepositories;

interface FileRepositoryInterface {
    /**
     * Get By id
     * @return mixed
     */
    public function get($id): FileObject;
    public function delete($id): bool;

    public function upload($file);
}