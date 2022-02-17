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

    public function upload($file) {
        echo '<pre>';
            print_r($file);
        echo '</pre>';
        $file['name'] = strip_tags($file['name']);
        if (
            $this->verifyMimeType($file)
            && $this->verifySize($file)
        ) {
            $explodedName = explode('.', $file['name']);
            $ext = end($explodedName);
            $filename = md5($file['name'] . '~' . microtime());
            $path = $this->dir . $filename . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $path)) {
                $fileObject = new FileObject((object) array(
                    'owner' => 0,
                    'repository' => $this->repositoryName,
                    'name' => md5($file['name'] . '~' . microtime()),
                    'file' => $file['name'],
                    'path' => $path,
                    'ext' => $ext,
                    'size' => $file['size'],
                    'hash' => md5_file($path),
                    'deleted' => 0
                ));
                $fileObject->save();
            } else {
                die('Error');
            }

        }
    }

    private function verifyMimeType($file): bool {
        return in_array(mime_content_type($file['tmp_name']), $this->config->get('repositories')->{$this->repositoryName}->mime_types);
    }
    private function verifySize($file): bool {
        return (filesize($file['tmp_name']) == $file['size'] && $file['size'] < $this->config->get('repositories')->{$this->repositoryName}->max_file_size);
    }
}