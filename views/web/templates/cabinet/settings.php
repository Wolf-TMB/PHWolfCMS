<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

?>

<div class="col-12 col-lg-8 mt-5">
    <div class="d-flex flex-column flex-lg-row align-items-center">
        <span  class="my-auto">
            <img width="250" src="/resources/img/favicon/android-chrome-512x512.png" class="rounded-circle" alt="">
        </span>
        <span class="my-auto fs-1 ms-lg-5">
            WilyFox <span class="ms-5"><a href="/cabinet"><img width="32" src="/resources/img/icons/back.png" alt=""></a></span>
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
                <th>IP</th>
                <th>Время</th>
            </tr>
            </thead>
            <tbody id="authLogTable">
            </tbody>
        </table>
    </div>
</div>

<script>
    $.ajax({
        url: 'https://phwolf.ilya-levin.ru/api/logs/<?= $app->user->id ?>/auth/1/10/get',
        type: 'GET',
        dataType: 'json',
        data: {},
        success: function(data, textStatus, xhr) {
            console.log(data)
            for (const datum of data) {
                let c = '';
                if (datum.context === 'site') c = 'Аутентификация на сайте';
                if (datum.context === 'launcher') c = 'Аутентификация в лаунчере';
                let date = new Date(datum.created_at * 1000);
                $('#authLogTable').append(`
                    <tr>
                        <td>${c}</td>
                        <td>${datum.ip}</td>
                        <td>${date.toLocaleDateString() + ' ' + date.toLocaleTimeString()}</td>
                    </tr>
                `);
            }
        },
        error: function(e) {
        }
    });
</script>

