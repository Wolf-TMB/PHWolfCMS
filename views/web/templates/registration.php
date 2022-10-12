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
            <form action="/registration" method="POST">
                {{@csrf_token}}
                <div class=" mb-3">
                    <label for="login" class=" form-label">Логин</label>
                    <input type="text" name="login" id="login" class=" form-control" value="<?= ($data->data->login) ?? '' ?>" required>
                </div>
                <div class=" mb-3">
                    <label for="email" class=" form-label">E-Mail</label>
                    <input type="email" name="email" id="email" class=" form-control" value="<?= ($data->data->email) ?? '' ?>" required>
                </div>
                <div class=" mb-3">
                    <label for="password" class=" form-label">Логин</label>
                    <input type="password" name="password" id="password" class=" form-control" required>
                </div>
                <div class=" mb-3">
                    <label for="password_confirm" class=" form-label">Повторите пароль</label>
                    <input type="password" name="password_confirm" id="password_confirm" class=" form-control" required>
                </div>
                <button type="submit">Зарегистрировать аккаунт</button>
            </form>
        </div>
    </div>
</div>