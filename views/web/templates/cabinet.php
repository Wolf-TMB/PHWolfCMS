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
            WilyFox <span class="ms-5"><a href="/settings"><img src="/resources/img/icons/settings.png" alt="" style="width: 32px"></a></span>
        </span>
    </div>
    <hr>
    <div class="fs-5">
        <div class="d-flex flex-row justify-content-between mb-2">Монтеы: 150<span><a href="" class="btn" style="background: white; border: 1px solid; color: black">Пополнить</a></span></div>
        <div class="d-flex flex-row justify-content-between">Голоса: 120<span><a href="/vote" class="btn" style="background: white; border: 1px solid; color: black">Голосовать</a></span></div>
    </div>
    <hr>
    <table class="table fs-5 border-start">
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
    <table class="table fs-5 border-start">
        <thead>
        <tr>
            <th>Сервер</th>
            <th>Срок действия</th>
            <th>Наказание</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>SkyBlock 1.12.2</td>
            <td> </td>
            <td><span class="badge bg-danger">Warn</span></td>
        </tr>
        <tr>
            <td>TechnoMagic 1.7.10</td>
            <td>до 01.03.2022</td>
            <td><span class="badge bg-danger">Mute</span></td>
        </tr>
        <tr>
            <td>MaxIndustrial 1.12.2</td>
            <td>Permanent</td>
            <td><span class="badge bg-danger">Ban</span></td>
        </tr>
        <tr>
            <td>SteamPunk 1.12.2</td>
            <td>до 01.04.2022</td>
            <td><span class="badge bg-danger">Jail</span></td>
        </tr>
        </tbody>
    </table>
    <div class="fs-5">
        <span>Дата регистрации: 11.02.2022</span>
    </div>
</div>

