<?php

namespace PHWolfCMS\Http\Controllers\API;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Modules\Facade\Auth;
use PHWolfCMS\Kernel\Modules\FileRepository\FileObject;

class UserController extends \PHWolfCMS\Kernel\Modules\Controller\BaseController {
    #[NoReturn] public function getAuth($login, $password) {
        if (Auth::fakeAttempt($login, $password)) {
            die('Ok');
        } else {
            die('Failed');
        }
    }

    public function getSkinGet($login) {
        global $app;
        /** @var FileObject|bool $file */
        $file = $app->fileRepository->get('skin')->getByLogin($login);
        if ($file === false) {
            die('Сделать вывод стандартного скина');
        }
        header('Content-Type: image/png');
        readfile($file->getPath());
    }

    public function getCloakGet($login) {
        global $app;
        /** @var FileObject $file */
        $file = $app->fileRepository->get('cloak')->getByLogin($login);
        if ($file === false) {
            die('Сделать вывод стандартного плаща');
        }
        header('Content-Type: image/png');
        readfile($file->getPath());
    }
}