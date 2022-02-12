<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

?>

<div class="registrationForm mb-5 mt-5 border-start py-4">
	<?php
	$app->html->form()
		->action('login')
		->method('POST')
		->inputText('lgin', 'login', true, 'Логин', true)
		->inputPassword('pass', 'pass', true, 'Пароль', true)
		->button('submit', 'Войти', 'bt')
		->button('submit', 'Регистрацияф', 'regbt')
		->print();
	?>
<!--    <form>-->
<!--        <div class="mb-3">-->
<!--            <input placeholder="ЛОГИН" type="email" class="form-control" id="login" aria-describedby="emailHelp" style="height: 2rem; border-radius: 15px">-->
<!--        </div>-->
<!--        <div class="mb-3">-->
<!--            <input placeholder="ПАРОЛЬ" type="password" class="form-control" id="password" style="height: 2rem; border-radius: 15px">-->
<!--        </div>-->
<!--        <div class="text-center">-->
<!--            <button type="submit" class="btn btn-primary mb-2 border-white" style="height: 2rem; width: 100%; background: linear-gradient(to right,#302b63,#24243e); padding: 0; border-radius: 15px;">Войти</button>-->
<!--            <a href="/registration" class="btn btn-primary" style="height: 2rem; background: white; color: black; padding: 0; border-radius: 15px; border-color: #302b63">Регистрация</a>-->
<!--        </div>-->
<!--    </form>-->

<!--    <div class="d-flex flex-row justify-content-sm-evenly">-->
<!--        <span class="my-auto">-->
<!--            <img style="width: 96px; border-radius: 50%" src="/resources/img/favicon/android-chrome-512x512.png" alt="">-->
<!--        </span>-->
<!--        <div class="my-auto d-flex flex-column">-->
<!--            <span class="fs-2">WilyFox</span>-->
<!--            <span class="d-flex flex-row justify-content-sm-between">150<span>120</span></span>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="text-center mt-4">-->
<!--        <a href="/cabinet" class="btn btn-primary">Личный кабинет</a>-->
<!--    </div>-->
<!--    <div class="text-center mt-2">-->
<!--        <a href="/logout" class="btn btn-light border border-dark">Выйти</a>-->
<!--    </div>-->
</div>

<style>
    #bt {
        width: 100%;
        background: linear-gradient(to right,#302b63,#24243e);
        border-radius: 20px;
    }
    #regbt {
        width: 100%;
        background: white;
        border: 1px solid;
        color: black;
        margin-top: 1rem;
        border-radius: 20px;
    }
</style>