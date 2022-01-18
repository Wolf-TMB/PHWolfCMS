<?php

namespace PHWolfCMS;

use PDO;

class Database {
    private PDO $connect;

    public function __construct() {
        global $app;
        $this->connect = new \PDO($app->config->get('DB_DRIVER').':host='. $app->config->get('DB_HOST') . ';port=' . $app->config->get('DB_PORT') . ';dbname=' . $app->config->get('DB_NAME') . ';charset=utf8;', $app->config->get('DB_USER'), $app->config->get('DB_PASS'), array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ));
    }

    public function getRecord($sql, $params = null, $orderColumn = 'id', $orderType = 'ASC'): array|bool {
        $sql .= " ORDER BY $orderColumn $orderType LIMIT 1";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function getRecords($sql, $params = null, $orderColumn = 'id', $orderType = 'ASC', $limit = 0): array {
        $sql .= " ORDER BY $orderColumn $orderType";
        $sql .= ($limit == 0) ? "" : " LIMIT $limit";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function insert($table, $params): bool {
        $columns = array_keys($params);
        $sql = "INSERT INTO $table (".implode(',', $columns).") VALUES(:".implode(', :', $columns).")";
        $stmt = $this->connect->prepare($sql);
        echo '<pre>';
            print_r($_SERVER);
        echo '</pre>';
        die();
        die($stmt->queryString);
        return $stmt->execute($params);
    }

    public function update($sql, $params): bool {
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute($params);
    }

    public function execute($sql, $params): bool {
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute($params);
    }

    private function log($sql, $params) {

    }
}
