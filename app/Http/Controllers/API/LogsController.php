<?php

namespace PHWolfCMS\Http\Controllers\API;

use PHWolfCMS\Kernel\Modules\Controller\BaseController;
use PHWolfCMS\Kernel\Modules\Facade\Auth;

class LogsController extends BaseController {
	public function getUseridActionPageGet($userid, $action, $from, $count) {
		global $app;
		if (!Auth::check()) die('Auth required');

		if ($app->user->id == $userid) {
			if (!property_exists($app->logger->actions, $action)) die('Undefined action');
			$data = $app->db->getRecords('SELECT l.id, l.user_id, l.data, l.ip, l.created_at, l.updated_at FROM logs as l WHERE l.action = :action AND l.user_id = :user_id AND l.id >= :from', ['action' => $app->logger->actions->{$action}->id, 'user_id' => $userid, 'from' => $from], ['id' => 'ASC'], $count);
			foreach ($data as &$row) {
				$decoded_data = json_decode($row->data);
				$row->context = $decoded_data->context;
				unset($row->data);
			}
			die(json_encode($data));
		}
		die('You don\'t have permissions');
	}
}