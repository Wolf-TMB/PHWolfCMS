<?php

namespace PHWolfCMS\Kernel\Modules\Model;

use PHWolfCMS\Exceptions\ModelCantReadProperty;
use PHWolfCMS\Exceptions\ModelCantWriteProperty;

abstract class BaseModel {
    private array $data = [];
    private static array $objects = [];

    public static function find(int|array $param) {
        global $app;
        if (gettype($param) == 'integer') {
            return self::_findAll(array(
                ['id', '=', $param]
            ));
        } else {
            return self::_findAll($param);
        }
    }

    public static function findAll(array $params) {
        global $app;
        return self::_findAll($params);
    }

    private static function _findAll(array|int $param) {
        global $app;
        $params = [];
        $sql = 'SELECT * FROM  ' . static::tableName() . ' WHERE';
        foreach ($param as $key => $value) {
            $i = count($params);
            if ($i > 0) $sql .= ' AND';
            $params[$value[0] . '_' . $i] = $value[2];
            $sql .= ' ' . $value[0] . ' ' . $value[1] . ' :' . $value[0] . '_' . $i;
        }
        $rows = $app->db->getRecords($sql, $params);
        if (count($rows) == 1) {
            static::$objects[] = (new static())->createModel($rows[0]);
        } else {
            foreach ($rows as $row) {
                static::$objects[] = (new static())->createModel($row);
            }
        }
        if (count(static::$objects) == 0) return [];
        if (count(static::$objects) == 1) return static::$objects[0];
        return static::$objects;
    }

    public function __construct(int $id = 0) {
        global $app;
        if ($id > 0) {
            $row = $app->db->getRecord('SELECT * FROM '. static::tableName() .' WHERE id = :id', array('id' => $id));
            return $this->createModel($row);
        }
        return $this;
    }

    public function createFromSQLData($row): static {
        return (new static())->createModel($row);
    }

    /**
     * Имя таблицы, с которой связана модель
     * @return string
     */
    abstract static function tableName(): string;

    /**
     * Перечень полей, которые доступны для записи
     * @return array
     */
    abstract static function fieldWriteAccess(): array;

    /**
     * Перечень полей, доступных для чтения
     * @return array
     */
    abstract static function fieldReadAccess(): array;

    private function createModel($data): static {
        $this->data = [];
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        return $this;
    }

    public function delete() {
        global $app;
        if ($this->id) {
            $app->db->delete(static::tableName(), $this->id);
            $this->data = [];
        }
    }

    public function save(): static {
        global $app;
        if ($this->id) {
            $sql = 'UPDATE ' . static::tableName() . ' SET';
            foreach ($this->data as $key => $value) {
                if ($key !=  'id') $sql .= ' ' . $key . ' = :' . $key . ',';
            }
            $sql = substr($sql,0,-1);
            $sql .= ' WHERE id = :id';
            $app->db->update($sql, $this->data);
        }
        return $this->refresh();
    }

    public function refresh(): static {
        global $app;
        if ($this->id) {
            $row = $app->db->getRecord('SELECT * FROM '.( static::tableName() ).' WHERE id = :id', array('id' => $this->id));
            $this->createModel($row);
        } else {
            $app->db->insert(static::tableName(), $this->data);
        }
        return $this;
    }

    /**
     * @throws ModelCantWriteProperty
     */
    public function __set(string $name, $value): void {
        $writeAccessFor = static::fieldWriteAccess();
        if (!in_array($name, $writeAccessFor) && key_exists($name, $this->data)) throw new ModelCantWriteProperty();
        $this->data[$name] = $value;
    }

    /**
     * @throws ModelCantReadProperty
     */
    public function __get(string $name) {
        $readAccessFor = array_merge(static::fieldWriteAccess(), static::fieldReadAccess());
        if (!in_array($name, $readAccessFor) && !in_array('*', $readAccessFor)) throw new ModelCantReadProperty();
        if (key_exists($name, $this->data)) return $this->data[$name];
        return null;
    }
}