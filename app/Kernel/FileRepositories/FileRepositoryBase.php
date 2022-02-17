<?php

namespace PHWolfCMS\Kernel\FileRepositories;

use PHWolfCMS\Kernel\Config;

abstract class FileRepositoryBase  implements FileRepositoryInterface {
    private string $repositoryName;
    private string $dir;
    protected Config $config;

    public function __construct($repositoryName) {
        $this->config = new Config('module', 'file_repository');
        $this->repositoryName = $repositoryName;

        $this->init();
    }

    private function init() {
        global $app;
        $dir = str_replace('{REPO_NAME}',  $this->repositoryName, $this->config->get('repo_dir'));
        $this->dir = $app->rootDir . $dir;
        if (!is_dir($this->dir)) {
            $dirs = explode('/', $dir);
            $currentDir = $app->rootDir;
            foreach ($dirs as $d) {
                if ($d != '') {
                    $currentDir .= '/' . $d;
                    if (!is_dir($currentDir)) mkdir($currentDir, 755);
                }
            }
        }
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