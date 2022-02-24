<?php

namespace PHWolfCMS\Kernel\Modules\Facade;

use PHWolfCMS\Models\Users;

class Auth {
    /**
     * Попытка аутентификации
     */
    public static function attempt($login, $password): bool {
        global $app;
        $user = Users::find(array(
            ['login', '=', $login]
        ));
        if (!$user) {
            $app->session->setFlash('authError', 'Пользователь не найден');
            return false;
        }
        if (!password_verify($password, $user->password)) {
            $app->session->setFlash('authError', 'Пароль не подошёл :(');
            return false;
        }
        $app->session->set('userid', $user->id);
        $app->refreshUserData();
        return true;
    }

    public static function logout(): bool {
        global $app;
        $app->session->unset('userid');
        $app->refreshUserData();
        return true;
    }

    public static function check(): bool {
        global $app;
        return (!($app->user === false));
    }
}