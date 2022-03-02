<?php
/**
 * @var App $app
 */

use PHWolfCMS\Kernel\Modules\App\App;

$data = json_decode($app->session->getFlash('registrationError'));
?>

<div class="col-12 col-lg-8 mt-5">
    <div class="col-12">
        <div class="col-6 offset-3">
            <?php if (!empty($data->messages)): ?>
                <div class="alert alert-danger">
                        <?php foreach ($data->messages as $message): ?>
                            - <?= $message ?> <br>
                        <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php
                $app->html->form()
                    ->action('registration')
                    ->method('POST')
                    ->csrf_token()
                    ->inputText('login', 'login', true, 'Логин', ['value' => ($data->data->login) ?? ''])
                    ->inputText('email', 'email', true, 'E-Mail', ['type' => 'email', 'value' => ($data->data->email) ?? ''])
                    ->inputPassword('password', 'password', true, 'Пароль')
                    ->inputPassword('password_confirm', 'password_confirm', true, 'Повторите пароль')
                    ->button('Регистрация', 'btn bg-primary text-white mx-auto')
                    ->print();
            ?>
        </div>
    </div>
</div>