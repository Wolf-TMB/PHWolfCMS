<?php

namespace PHWolfCMS\Kernel\Modules\Facade;

use PHWolfCMS\Models\User;

class Auth {
    /**
     * Попытка аутентификации
     */
    public static function attempt($login, $password, $code2fa = null): string {
        global $app;
        $user = User::find(array(
            ['login', '=', $login]
        ));

        if (!$user || !password_verify($password, $user->password)) {
            return 'InvalidLoginOrPassword';
        }

	    if (property_exists($user->settings, 'u_2fa_enabled') && $user->settings->u_2fa_enabled->value == true && !$app->googleAuthenticator->checkCode($user->settings->u_2fa_secret->value, $code2fa)) {
		    return 'InvalidCode2fa';
	    }

        $app->session->set('userid', $user->id);
        $app->refreshUserData();

		$app->logger->log($user->id, 'auth', json_encode(array('context' => 'site', 'login' => $user->login, 'code2fa' => $code2fa)), $_SERVER['REMOTE_ADDR']);
        return 'Success';
    }

    /**
     * Попытка аутентификации
     */
    public static function fakeAttempt($login, $password, $type = 'test', $code2fa = null): string {
        global $app;
        $user = User::find(array(
            ['login', '=', $login]
        ));

        if (!$user || !password_verify($password, $user->password)) {
            return 'InvalidLoginOrPassword';
        }

	    if (property_exists($user->settings, 'u_2fa_enabled') && $user->settings->u_2fa_enabled->value == true) {
			if (is_null($code2fa) || !$app->googleAuthenticator->checkCode($user->settings->u_2fa_secret->value, $code2fa)) {
				return 'InvalidCode2fa';
			}
	    }
		if ($type != 'test') {
			$app->logger->log($user->id, 'auth', json_encode(array('context' => $type, 'login' => $user->login, 'code2fa' => $code2fa)), $_SERVER['REMOTE_ADDR']);
		}
	    return 'Success';
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