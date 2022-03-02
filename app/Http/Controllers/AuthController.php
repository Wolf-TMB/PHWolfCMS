<?php

namespace PHWolfCMS\Http\Controllers;

use PHWolfCMS\Models\User;
use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Facade\Auth;
use PHWolfCMS\Exceptions\CSRFProtectionException;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;
use PHWolfCMS\Exceptions\ValidatorNotFoundException;
use PHWolfCMS\Kernel\Modules\Controller\BaseController;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use PHWolfCMS\Exceptions\ValidatorMethodNotFoundException;
use PHWolfCMS\Exceptions\RenderMaxIterationLimitException;
use PHWolfCMS\Exceptions\RenderFileBlockNotFoundException;
use PHWolfCMS\Exceptions\RenderFileLayoutNotFoundException;
use PHWolfCMS\Exceptions\RenderFileTemplateNotFoundException;

class AuthController extends BaseController {
    /**
     * @throws CSRFProtectionException
     */
    #[NoReturn] public function postLogin() {
        global $app;
        $data = $this->getRequestData(RequestMethod::POST);
        if (!Auth::attempt($data['login'], $data['password'])) {
            $app->session->setFlash('loginError', json_encode(array(
                'messages' => array(
                    'Неверный логин или пароль.'
                ),
                'data' => array(
                    'login' => $data['login'],
                )
            )));
        }
        $this->redirect(($app->refer) ?? '/');
    }

    /**
     * @throws RenderFileLayoutNotFoundException
     * @throws RenderFileTemplateNotFoundException
     * @throws RenderMaxIterationLimitException
     * @throws ConfigKeyNotFoundException
     * @throws RenderFileBlockNotFoundException
     * @throws HttpRouteNotFoundException
     */
    #[NoReturn] public function getRegistration() {
        $this->render(
            template: 'registration',
            layout: 'main',
            params: array(
                'title' => 'Регистрация'
            )
        );
    }

    /**
     * @throws ValidatorNotFoundException
     * @throws ConfigKeyNotFoundException
     * @throws ValidatorMethodNotFoundException
     * @throws CSRFProtectionException
     */
    #[NoReturn] public function postRegistration() {
        global $app;
        $data = $this->getRequestData(RequestMethod::POST);
        $userConfirm = false;
        if (
            $app->validator->get('password')->validate($data['password'])
            && $data['password'] == $data['password_confirm']
            && $app->validator->get('login')->validate($data['login'])
            && $app->validator->get('email')->validate($data['email'])
        ) {
            $userConfirm = User::find(array(['login', '=', $data['login'], 'OR'], ['email', '=', $data['email']]));
            if (!$userConfirm) {
                $user = new User();
                $user->login = $data['login'];
                $user->email = $data['email'];
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                $user->save();
                $this->redirect('/');
            }
        }
        $errors = [];
        if (!$app->validator->get('password')->validate($data['password'])) $errors[] = 'Пароль должен содержать более 8-ми символов, минимум 1 заглавную букву и цифру.';
        if ($data['password'] != $data['password_confirm']) $errors[] = 'Введённые пароли не совпадают.';
        if (!$app->validator->get('login')->validate($data['login'])) $errors[] = 'Логин имеет неверный формат или недопустимые символы (разрешено использовать латинские буквы, цифры и символ "_").';
        if (!$app->validator->get('email')->validate($data['email'])) $errors[] = 'Электронная почта имеет недопустимый формат.';
        if ($userConfirm) $errors[] = 'Аккаунт с таким логином или почтой уже существует.';

        $app->session->setFlash('registrationError', json_encode(array(
            'messages' => $errors,
            'data' => array(
                'login' => $data['login'],
                'email' => $data['email'],
            )
        )));
        $this->redirect('/registration');
    }
}