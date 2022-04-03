<?php

namespace PHWolfCMS\Kernel\Modules\Model;

use PHWolfCMS\Models\User;
use PHWolfCMS\Exceptions\ModelCantReadProperty;
use PHWolfCMS\Exceptions\ModelCantWriteProperty;

abstract class BaseModel {
    private array $data = [];
    private static array $objects = [];

    /**
     * Поиск записей по параметрам
     * @param int|array $param
     * @param int $limit
     * @param array $order
     *
     * @return array|object
     */
    public static function find(int|array $param, int $limit = 0, array $order = ['id' => 'ASC']): object|array {
        global $app;
        if (gettype($param) == 'integer') {
            return self::_findAll(array(
                ['id', '=', $param]
            ), $limit, $order);
        } else {
            return self::_findAll($param, $limit, $order);
        }
    }

    /**
     * Все записи с соответствующими параметрами и возможность ограничения количества
     * @param array $params
     * @param int $limit
     *
     * @return array|object
     */
    public static function findAll(array $params, int $limit = 0): array|object {
        global $app;
        return self::_findAll($params, $limit);
    }

    /**
     * Выборка всех записей с возможностью ограничения количества
     * @param int $limit
     *
     * @return array|object
     */
    public static function all(int $limit = 0): array|object {
        return self::_findAll([], $limit);
    }

    /**
     * Возвращает модель или массив моделей на основе переданных параметров
     *
     * @param array $param
     * @param int $limit
     * @param array $order
     *
     * @return array|object
     */
    private static function _findAll(array $param = [], int $limit = 0, array $order = ['id' => 'ASC']): array|object {
        global $app;
        $params = [];
        $sql = 'SELECT * FROM ' . static::tableName() . ((empty($param)) ? '' : ' WHERE');
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $i = count($params);
                $params[$value[0] . '_' . $i] = $value[2];
                $sql .= ' ' . $value[0] . ' ' . $value[1] . ' :' . $value[0] . '_' . $i;
                if (key_exists(3, $value)) $sql .= ' ' . $value[3];
            }
            $rows = $app->db->getRecords($sql, $params, $order, $limit);
        } else {
            $rows = $app->db->getRecords($sql, null, $order, $limit);
        }
        if (count($rows) == 1) {
            static::$objects[] = (new static())->createModel($rows[0]);
        } else {
            foreach ($rows as $row) {
                static::$objects[] = (new static())->createModel($row);
            }
        }

		foreach (static::$objects as &$object) {
			static::loadData($object);
		}

	    if (count(static::$objects) == 0) return [];
	    if (count(static::$objects) == 1) return static::$objects[0];
		return self::$objects;
    }


    /**
     * Если передан id, то будет создана модель, иначе будет создана пустая модель
     * @param int $id
     */
    public function __construct(int $id = 0) {
        global $app;
        if ($id > 0) {
            $row = $app->db->getRecord('SELECT * FROM '. static::tableName() .' WHERE id = :id', array('id' => $id));
            return $this->createModel($row);
        }
        return $this;
    }

    /**
     * Создаёт модель на основе строки из базы данных
     * @param $row
     *
     * @return $this
     */
    public function createFromSQLData($row): static {
        return (new static())->createModel($row);
    }

    /**
     * Имя таблицы, с которой связана модель
     * @return string
     */
    protected abstract static function tableName(): string;

    /**
     * Перечень полей, которые доступны для записи
     * @return array
     */
    protected abstract static function fieldWriteAccess(): array;

    /**
     * Перечень полей, доступных для чтения
     * @return array
     */
    protected abstract static function fieldReadAccess(): array;

    /**
     * Создаёт модель на основе переданных данных
     * @param $data
     *
     * @return $this
     */
    private function createModel($data): static {
        $this->data = [];
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        return $this;
    }


    /**
     * Метод удаляет данные, связанные с текущей моделью
     * @return void
     */
    public function delete() {
        global $app;
        if ($this->id) {
            $app->db->delete(static::tableName(), $this->id);
            $this->data = [];
        }
    }

    /**
     * Метод обновляет данные в базе данных на основе данных модели
     * @return $this
     */
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

    /**
     * Метод обновляет данные модели из базы данных, если задан id или создаёт новую запись
     * @return $this
     */
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