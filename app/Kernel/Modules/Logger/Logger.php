<?php

namespace PHWolfCMS\Kernel\Modules\Logger;


use PHWolfCMS\Exceptions\UndefinedLoggerActionException;
use stdClass;

class Logger {
	public object $actions;

	public function __construct() {
		global $app;
		$this->actions = new StdClass();
		$data = $app->db->getRecords('SELECT id, action_key, name FROM log_actions');
		foreach ($data as $row) {
			$this->actions->{$row->action_key} = (object) ['id' => $row->id, 'key' => $row->action_key, 'name' => $row->name];
		}
	}

	public function get(array $param, int $count = 10, $order = ['id' => 'ASC']): array {
		global $app;
		$param = array_merge($param);
		$params = [];
		$sql = 'SELECT * FROM logs' . ((empty($param)) ? '' : ' WHERE');
		if (!empty($param)) {
			foreach ($param as $key => $value) {
				$i = count($params);
				$params[$value[0] . '_' . $i] = $value[2];
				$sql .= ' ' . $value[0] . ' ' . $value[1] . ' :' . $value[0] . '_' . $i;
				if (key_exists(3, $value)) $sql .= ' ' . $value[3];
			}
			$rows = $app->db->getRecords($sql, $params, $order, $count);
		} else {
			$rows = $app->db->getRecords($sql, null, $order, $count);
		}
		return $rows;
	}

	/**
	 * @throws UndefinedLoggerActionException
	 */
	public function log(int|null $user_id, string $action, string $data, string $ip) {
		global $app;
		if (!property_exists($this->actions, $action)) throw new UndefinedLoggerActionException();
		$app->db->insert('logs', array(
			'user_id' => $user_id,
			'action' => $this->actions->{$action}->id,
			'data' => $data,
			'ip' => $ip
		));
	}
}