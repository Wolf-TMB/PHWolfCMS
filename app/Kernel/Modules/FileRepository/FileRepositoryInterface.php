<?php

namespace PHWolfCMS\Kernel\Modules\FileRepository;

interface FileRepositoryInterface {
    public function get($id): FileObject;
    public function delete($id): bool;

    public function upload($file);
}