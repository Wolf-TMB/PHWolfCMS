<?php

namespace PHWolfCMS\Models;

use PHWolfCMS\Kernel\Modules\Model\BaseModel;

class User extends BaseModel {

	static function tableName(): string {
		return 'users';
	}

	static function fieldWriteAccess(): array {
		return ['money'];
	}

	static function fieldReadAccess(): array {
		return ['*'];
	}
}