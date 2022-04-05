<?php

namespace PHWolfCMS\Http\Controllers\API;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Modules\Facade\Auth;
use PHWolfCMS\Kernel\Modules\Libs\SkinViewer;
use PHWolfCMS\Kernel\Modules\FileRepository\FileObject;
use PHWolfCMS\Models\User;

class UserController extends \PHWolfCMS\Kernel\Modules\Controller\BaseController {
    #[NoReturn] public function getAuth($login, $password, $code2fa = null) {
		global $app;
		$autResult = Auth::fakeAttempt($login, $password, 'launcher', $code2fa);
	    header('Content-Type: text/html; charset=utf-8');

	    die(
		    match ($autResult) {
			    'InvalidCode2fa' => 'Need2fa',
			    'Success' => 'OK:' . $login,
			    'InvalidLoginOrPassword' => 'Неверный логин или пароль.',
			    default => ''
		    }
	    );
    }

	public function getCheck2fa($login): string {
		$user = User::find([['login', '=', $login]]);
		if ($user) {
			return (property_exists($user->settings, 'u_2fa_enabled')) ? 'enabled' : 'disabled';
		}
		return 'disabled';
	}

    public function getSkinGet($login) {
        global $app;
        /** @var FileObject|bool $file */
        $file = $app->fileRepository->get('skin')->getByLogin($login);
        if ($file === false) {
            die('Подгружать стандартный файл');
        }
        header('Content-Type: image/png');
        readfile($file->getPath());
    }

    public function getCloakGet($login) {
        global $app;
        /** @var FileObject|bool $file */
        $file = $app->fileRepository->get('cloak')->getByLogin($login);
        if ($file === false) {
            die('Подгружать стандартный файл');
        }
        header('Content-Type: image/png');
        readfile($file->getPath());
    }

    public function getSkinPreviewGet($login) {
        global $app;
        /** @var FileObject|bool $file */
        $file = $app->fileRepository->get('skin')->getByLogin($login);
        if ($file === false) {
            die('Подгружать стандартный файл');
        }
        header('Content-Type: image/png');
        imagepng(SkinViewer::createPreview($file->getPath()));
    }
    public function getSkinHeadGet() {

    }
}