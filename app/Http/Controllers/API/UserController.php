<?php

namespace PHWolfCMS\Http\Controllers\API;

use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Modules\Facade\Auth;
use PHWolfCMS\Kernel\Modules\Libs\SkinViewer;
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