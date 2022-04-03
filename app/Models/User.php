<?php

namespace PHWolfCMS\Models;

use PHWolfCMS\Kernel\Modules\Model\BaseModel;

/**
 * @property int $id ID пользователя
 * @property string $login Логин пользователя
 * @property string $email Электронная почта пользователя
 * @property string $password Хеш пароля пользователя
 * @property int $money Баланс пользователя
 * @property array $settings Баланс пользователя
 * @property string $created_at Дата создания аккаунта пользователя в UNIX
 * @property string $updated_at Дата последнего изменения аккаунта пользователя в UNIX
 *
 * @method static User find(int|array $param, array $leftJoin = [], int $limit = 0, array $order = ['id' => 'ASC'])
 * @method static User findAll(array $params, int $limit = 0)
 * @method static User all(int $limit = 0)
 * @method User createFromSQLData($row)
 * @method void delete()
 * @method User save()
 * @method User refresh()
 */
class User extends BaseModel {

	public function getSettings() {
		global $app;
		$settings_raw = $app->db->getRecords('SELECT us.id, s.setting_key, s.setting_name, us.setting_id, us.value FROM user_settings as us LEFT JOIN settings as s ON s.id = us.setting_id WHERE us.user_id = :user_id', ['user_id' => $this->id]);
		$settings = (object) [];
		foreach ($settings_raw as $s) {
			$settings->{$s->setting_key} = (object) array(
				'setting_id' => $s->setting_id,
				'setting_name' => $s->setting_name,
				'setting_key' => $s->setting_key,
				'value' => $s->value
			);
		}
		echo '<pre>';
		    print_r($settings);
		echo '</pre>';
	}

	protected static function tableName(): string {
		return 'users';
	}

    protected static function fieldWriteAccess(): array {
		return ['money'];
	}

    protected static function fieldReadAccess(): array {
		return ['*'];
	}
}