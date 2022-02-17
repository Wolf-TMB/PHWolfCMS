<?php

namespace PHWolfCMS\Kernel\FileRepositories;

use PHWolfCMS\Kernel\Config;

abstract class FileRepositoryBase  implements FileRepositoryInterface {
    private string $repositoryName;
    protected Config $config;

    public function __construct($repositoryName) {
        $this->config = new Config('module', 'file_repository');
        $this->repositoryName = $repositoryName;
    }

    public function get($id): FileObject {
        global $app;
        $data = $app->db->getRecord('SELECT * FROM files WHERE id = :id', array('id' => $id));
        return new FileObject($data);
    }

    public function delete($id): bool {
        global $app;
        return $app->db->update('UPDATE files SET deleted = 1 WHERE id = :id', array('id' => $id));
    }

    public function upload() {
        
    }
}