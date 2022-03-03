<?php

namespace PHWolfCMS\Kernel\Modules\Facade;

use PHWolfCMS\Models\User;

class Auth {
    /**
     * Попытка аутентификации
     */
    public static function attempt($login, $password): bool {
        global $app;
        $user = User::find(array(
            ['login', '=', $login]
        ));

        if (!$user || !password_verify($password, $user->password)) {
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