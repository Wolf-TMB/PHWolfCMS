<?php
/**
 * @var App $app
 */

use PHWolfCMS\Kernel\Modules\App\App;
use PHWolfCMS\Kernel\Modules\Facade\Auth;

$data = json_decode($app->session->getFlash('loginError'));
?>

<div class="registrationForm mb-5 mt-5 border-start py-4">
    <div class="text-center w-100">
        <?php if (!empty($data->messages)): ?>
            <div class="alert alert-danger">
                <?php foreach ($data->messages as $message): ?>
                    - <?= $message ?> <br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!Auth::check()): ?>
            <?php
                $app->html->form()
                    ->action('login')
                    ->method('POST')
                    ->csrf_token()
                    ->inputText('login', 'login', true, 'Логин', ['value' => ($data->data->login) ?? ''])
                    ->inputPassword('password', 'password', true, 'Пароль')
                    ->button('Войти', 'btn w-100 text-white rounded-pill wc-background-gradient', 'bt')
                    ->addElement($app->html->link()->content('Зарегистрироваться')->href('/registration')->addClass('btn w-100 text-black rounded-pill bg-white mt-2 border border-dark')->getHtml(), false)
                    ->print();
            ?>
        <?php else: ?>
            <div class="d-flex flex-row justify-content-evenly">
            <span class="my-auto">
                <img width="96" class="rounded-circle" src="/resources/img/favicon/android-chrome-512x512.png" alt="">
            </span>
                <div class="my-auto d-flex flex-column">
                    <span class="fs-2">WilyFox</span>
                    <span class="d-flex flex-row justify-content-between"><?= $app->user->money ?><span><?= $app->user->votes ?></span></span>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="/cabinet" class="btn btn-primary w-75">Личный кабинет</a>
            </div>
            <div class="text-center mt-2">
                <a href="/logout" class="btn btn-light border border-dark w-75">Выйти</a>
            </div>
        <?php endif; ?>
</div>