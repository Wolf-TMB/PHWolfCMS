<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

?>

<div class="registrationForm mb-5 mt-5 border-start py-4">
    <div class="text-center w-100">
        <?php
        $app->html->form()
            ->action('login')
            ->method('POST')
            ->inputText('lgin', 'login', true, 'Логин')
            ->inputPassword('pass', 'pass', true, 'Пароль')
            ->button('Войти', 'btn w-100 text-white rounded-pill wc-background-gradient', 'bt')
            ->addElement($app->html->link()->content('Зарегистрироваться')->href('/registration')->addClass('btn w-100 text-black rounded-pill bg-white mt-2 border border-dark')->getHtml(), false)
            ->print();
        ?>
<!--        <div class="d-flex flex-row justify-content-evenly">-->
<!--            <span class="my-auto">-->
<!--                <img width="96" class="rounded-circle" src="/resources/img/favicon/android-chrome-512x512.png" alt="">-->
<!--            </span>-->
<!--            <div class="my-auto d-flex flex-column">-->
<!--                <span class="fs-2">WilyFox</span>-->
<!--                <span class="d-flex flex-row justify-content-between">150<span>120</span></span>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="text-center mt-4">-->
<!--            <a href="/cabinet" class="btn btn-primary w-75">Личный кабинет</a>-->
<!--        </div>-->
<!--        <div class="text-center mt-2">-->
<!--            <a href="/logout" class="btn btn-light border border-dark w-75">Выйти</a>-->
        </div>
</div>