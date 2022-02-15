<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

?>

<div class="col-12 col-lg-8 mt-5">
    <div class="col-12">
        <div class="col-6 offset-3">
            <?php
                $app->html->form()
                    ->action('registration')
                    ->method('POST')
                    ->inputText('login', 'login', true, 'Логин', [])
                    ->inputText('email', 'email', true, 'E-Mail', [])
                    ->inputPassword('pass', 'pass', true, 'Пароль', [])
                    ->inputPassword('pass2', 'pass2', true, 'Повторите пароль', [])
                    ->button('Регистрация', 'btn bg-primary text-white mx-auto')
                    ->print();
            ?>
        </div>
    </div>
</div>