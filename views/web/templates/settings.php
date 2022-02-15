<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

?>

<div class="col-12 col-lg-8 mt-5">
    <div class="d-flex flex-column flex-lg-row align-items-center">
        <span  class="my-auto">
            <img src="/resources/img/favicon/android-chrome-512x512.png" alt="" style="width: 250px; border-radius: 50%">
        </span>
        <span class="my-auto fs-1 ms-lg-5">
            WilyFox <span class="ms-5"><a href="/cabinet"><img src="/resources/img/icons/back.png" alt="" style="width: 32px"></a></span>
        </span>
    </div>
    <hr>
        <div class="fs-5">
            <div class="d-flex flex-row justify-content-between mb-2">Статус Google 2fa<span class="badge bg-success">Подключена</span></div>
            <div class="d-flex flex-row justify-content-between">Аккаунт VK<span class="badge bg-success">Подключен</span></div>
        </div>
    <hr>
    <div class="fs-5">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
            <label class="form-check-label" for="flexSwitchCheckDefault">Уведомления о попытке входа в аккаунт</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
            <label class="form-check-label" for="flexSwitchCheckDefault">Уведомления о входе в аккаунт</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
            <label class="form-check-label" for="flexSwitchCheckDefault">Уведомления о выходе из аккаунта</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
            <label class="form-check-label" for="flexSwitchCheckDefault">Уведомления о смене пароля</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
            <label class="form-check-label" for="flexSwitchCheckDefault">Уведомления от администрации проекта</label>
        </div>
    </div>
    <hr>
    <div class="fs-5">
        Последние логи аутентификации:
        <table class="table">
            <thead>
            <tr>
                <th>Действие</th>
                <th>Время</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Вход в аккаунт</td>
                <td>01.01.2022</td>
            </tr>
            <tr>
                <td>Вход в аккаунт</td>
                <td>13.02.2022</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

