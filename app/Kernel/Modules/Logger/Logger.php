<?php

namespace PHWolfCMS\Kernel\Modules\Logger;


class Logger {
	public function get(array $param, int $count = 10, $order = ['id' => 'ASC']) {
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

	public function log(int|null $user_id, string $action, string $data, string $ip) {
		global $app;
		$app->db->insert('logs', array(
			'user_id' => $user_id,
			'action' => $action,
			'data' => $data,
			'ip' => $ip
		));
	}
}