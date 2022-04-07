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
            <form action="<?= $app->router->route('post.login') ?>" method="POST" id="loginForm">
                {{@csrf_token}}
                <div id="loginFormMessages" class="mb-3 d-none alert">

                </div>
                <div class=" mb-3">
                    <label for="login" class=" form-label">Логин</label>
                    <input type="text" name="login" id="login" class=" form-control" value="<?= ($data->data->login) ?? '' ?>" required>
                </div>
                <div class=" mb-3">
                    <label for="password" class=" form-label">Пароль</label>
                    <input type="text" name="password" id="password" class=" form-control" required>
                </div>
                <div id="loginForm2faBlock" class=" mb-3 d-none">
                    <label for="code2fa" class=" form-label">Код двухфакторной аутентификации</label>
                    <input type="hidden" name="code2fa" id="code2fa" class="form-control" required>
                </div>
                <button>Войти</button>
            </form>
            <script>
                $('#loginForm').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?= $app->router->route('post.login') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: $(this).serialize(),
                        success: function(data, textStatus, xhr) {
                            console.log(data)
                            let loginFormMessages = $('#loginFormMessages');
                            loginFormMessages.empty();
                            switch (data.response) {
                                case 'InvalidLoginOrPassword':
                                    loginFormMessages.append(`<span>Неверный логин или пароль.</span>`);
                                    loginFormMessages.removeClass('d-none');
                                    break;
                                case 'InvalidCode2fa':
                                    loginFormMessages.append(`<span>Введите код двухфакторной аутентификации.</span>`);
                                    loginFormMessages.removeClass('d-none');
                                    $('#loginForm2faBlock').removeClass('d-none');
                                    $('#loginForm2faBlock input').attr('type', 'text');
                                    break;
                                case 'Success':
                                    window.location.reload(true);
                                    break;
                            }
                        },
                        error: function(e) {
                        }
                    });
                });
            </script>
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