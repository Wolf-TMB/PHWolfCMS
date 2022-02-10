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
                    ->inputText('login', 'login', true, 'Ник', true)
                    ->inputPassword('pass', 'pass', true, 'Пароль', true)
                    ->print();
            ?>
        </div>
    </div>
</div>