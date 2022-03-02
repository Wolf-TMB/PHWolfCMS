<?php

namespace PHWolfCMS\Http\Controllers;

use PHWolfCMS\Models\User;
use JetBrains\PhpStorm\NoReturn;
use PHWolfCMS\Kernel\Enums\RequestMethod;
use PHWolfCMS\Kernel\Modules\Validator\Validator;
use PHWolfCMS\Kernel\Modules\Controller\BaseController;

class AuthController extends BaseController {
    public function postLogin() {
        echo '<pre>';
            print_r($this->getRequestData(RequestMethod::POST));
        echo '</pre>';
    }

    #[NoReturn] public function getRegistration() {
        $this->render(
            'registration',
            'main',
            array(
                'title' => 'Регистрация'
            )
        );
    }

    public function postRegistration() {
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
                return $this->redirect('/');
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
        return $this->redirect('/registration');
    }
}