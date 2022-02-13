<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

?>

<div class="col-12 col-lg-8 mt-5">
    <div class="d-flex flex-row">
        <span  class="my-auto">
            <img src="/resources/img/favicon/android-chrome-512x512.png" alt="" style="width: 250px; border-radius: 50%">
        </span>
        <span class="my-auto fs-1 ms-5">
            WilyFox
        </span>
    </div>
    <hr>
    <table class="table fs-5">
        <thead>
            <tr>
                <th>Сервер</th>
                <th>Срок действия</th>
                <th>Группа</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>SkyBlock 1.12.2</td>
                <td>до 01.01.2022</td>
                <td><span class="badge bg-warning">Creator</span></td>
            </tr>
            <tr>
                <td>TechnoMagic 1.7.10</td>
                <td>до 01.01.2022</td>
                <td><span class="badge bg-warning">Creator</span></td>
            </tr>
            <tr>
                <td>MaxIndustrial 1.12.2</td>
                <td>до 01.01.2022</td>
                <td><span class="badge bg-warning">Creator</span></td>
            </tr>
            <tr>
                <td>SteamPunk 1.12.2</td>
                <td>до 01.01.2022</td>
                <td><span class="badge bg-warning">Creator</span></td>
            </tr>
        </tbody>
    </table>
    <div class="fs-5 mt-5">
        <div class="d-flex flex-row justify-content-sm-between mb-2">Монтеы: 150<span><a href="" class="btn" style="background: white; border: 1px solid; color: black">Пополнить</a></span></div>
        <div class="d-flex flex-row justify-content-sm-between">Голоса: 120<span><a href="/vote" class="btn" style="background: white; border: 1px solid; color: black">Голосовать</a></span></div>
    </div>
    <hr>
    <div class="fs-5">
        <span>Дата регистрации: 11.02.2022</span>
    </div>
    <hr>
    <div class="fs-5">
        <div class="d-flex flex-row justify-content-sm-between mb-4">Статус двухфакторной аутентификации: <span class="badge bg-success my-auto p-2">Активна</span></div>
        <div class="d-flex flex-row justify-content-sm-between">Аккаунт ВК: <span class="badge bg-success my-auto p-2">Привязан</span></div>
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
    <div class="ww-border rounded mt-3 p-2 text-center uploadskin-block">
        <div class="mb-3">
            <img src="https://letnicraft.ru/api/getSkin?type=front&nickname=AwdAwd" alt="">
            <img src="https://letnicraft.ru/api/getSkin?type=back&nickname=AwdAwd" alt="">
        </div>
        <div class="">
            <form id="form-upload-skin" enctype="multipart/form-data" action="/uploadSkin" method="POST">
                <div class="notify rounded">
                </div>
                <div class="input-group mb-3">
                    <label style="width: 82px" class="input-group-text fw-bold fs-5" for="fileSkin">Скин</label>
                    <input name="fileSkin" type="file" class="form-control fs-5" id="fileSkin">
                </div>
                <div class="input-group mb-3">
                    <label style="width: 82px" class="input-group-text fw-bold fs-5" for="fileCloak">Плащ</label>
                    <input name="fileCloak" type="file" class="form-control fs-5" id="fileCloak">
                </div>
                <button class="btn fs-5" type="submit" style="background: white; border: 1px solid; color: black">Загрузить</button>
            </form>
        </div>
    </div>
    <hr>
    <div>
        Последние логи аутентификации:
        <table class="table fs-5">
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

