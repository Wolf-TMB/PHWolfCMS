<?php

namespace PHWolfCMS\Kernel\Modules\FileRepository;

class CloakFileRepository extends FileRepositoryBase {
    public function getByLogin(string $login): bool|FileObject {
        global $app;
        $data = $app->db->getRecord('SELECT f.* FROM files as f LEFT JOIN users u on f.owner = u.id WHERE u.login = :login AND repository = :repository AND deleted = 0', array('login' => $login, 'repository' => $this->repositoryName), ['id' => 'DESC']);
        if ($data) return new FileObject($data);
        return false;
    }

    /**
     * @param $login
     *
     * @return FileObject[]
     */
    public function getAllByLogin($login): array {
        global $app;
        $files = [];
        $data = $app->db->getRecords('SELECT f.* FROM files as f LEFT JOIN users u on f.owner = u.id WHERE u.login = :login AND repository = :repository AND deleted = 0', array('login' => $login, 'repository' => $this->repositoryName));
        foreach ($data as $row) {
            $files[] = new FileObject($row);
        }
        return $files;
    }
}