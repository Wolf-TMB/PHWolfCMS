<?php

namespace PHWolfCMS\Models;

use PHWolfCMS\Kernel\Modules\Model\BaseModel;

/**
 * @property int $id ID пользователя
 * @property string $login Логин пользователя
 * @property string $email Электронная почта пользователя
 * @property string $password Хеш пароля пользователя
 * @property int $money Баланс пользователя
 * @property string $created_at Дата создания аккаунта пользователя в UNIX
 * @property string $updated_at Дата последнего изменения аккаунта пользователя в UNIX
 *
 * @method static User find(int|array $param, int $limit = 0, array $order = ['id' => 'ASC'])
 * @method static User findAll(array $params, int $limit = 0)
 * @method static User all(int $limit = 0)
 * @method User createFromSQLData($row)
 * @method void delete()
 * @method User save()
 * @method User refresh()
 */
class User extends BaseModel {

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