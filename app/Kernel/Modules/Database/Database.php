<?php

namespace PHWolfCMS\Kernel\Modules\Database;

use PDO;
use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;

class Database {
    private PDO $connect;
	private Config $config;

	/**
	 * @throws ConfigKeyNotFoundException
	 */
	public function __construct() {
		$this->config = new Config('module', 'database');
        $this->connect = new PDO($this->config->get('DB_DRIVER').':host='. $this->config->get('DB_HOST') . ';port=' . $this->config->get('DB_PORT') . ';dbname=' . $this->config->get('DB_NAME') . ';charset=utf8;', $this->config->get('DB_USER'), $this->config->get('DB_PASS'), array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ));
    }

    public function getRecord($sql, $params = null, array $order = ['id' => 'ASC']): object|bool {
        $sql .= " ORDER BY";
        foreach ($order as $column => $type) {
            $sql .= " $column $type";
        }
        $sql .= " LIMIT 1";
        $stmt = $this->connect->prepare($sql);
        $this->log($stmt->queryString, $params);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function getRecords($sql, $params = null, array $order = ['id' => 'ASC'], $limit = 0): array {
        $sql .= " ORDER BY";
        foreach ($order as $column => $type) {
            $sql .= " $column $type";
        }
        $sql .= ($limit == 0) ? "" : " LIMIT $limit";
        $stmt = $this->connect->prepare($sql);
        $this->log($stmt->queryString, $params);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function insert($table, $params): bool|int {
        $params = array_merge($params, array(
            'created_at' => time(),
            'updated_at' => time()
        ));
        $columns = array_keys($params);
        $sql = "INSERT INTO $table (".implode(',', $columns).") VALUES(:".implode(', :', $columns).")";
        $stmt = $this->connect->prepare($sql);
        $this->log($stmt->queryString, $params);
        $stmt->execute($params);
        return $this->connect->lastInsertId();
    }

    public function delete($table, $id): bool {
        $stmt = $this->connect->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
        $this->log($stmt->queryString, array('id' => $id));
        return $stmt->execute(array('id' => $id));
    }

    public function update($sql, $params): bool {
        $params = array_merge($params, array(
            'updated_at' => time()
        ));
        $sql = str_replace('SET', 'SET updated_at = :updated_at,', str_replace('updated_at = :updated_at', '', $sql));
        $stmt = $this->connect->prepare($sql);
        $this->log($stmt->queryString, $params);
        return $stmt->execute($params);
    }

    public function execute($sql, $params): bool {
        $stmt = $this->connect->prepare($sql);
        $this->log($stmt->queryString, $params);
        return $stmt->execute($params);
    }

	/**
	 * @throws ConfigKeyNotFoundException
	 */
	private function log($sql, $params) {
        global $app;
        if ($this->config->get('DB_SQL_LOG')) {
            $stmt = $this->connect->prepare('INSERT INTO log_sql (query, params, page, user_id, created_at, updated_at) VALUES (:query, :params, :page, :user_id, :created_at, :updated_at)');
            $stmt->execute(array(
                'query' => $sql,
                'params' => json_encode($params),
                'page' => $_SERVER['REQUEST_URI'],
                'user_id' => 0,
                'created_at' => time(),
                'updated_at' => time()
            ));
        }
    }
}
