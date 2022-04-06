<?php
/**
 * @var App $app
 */

use PHWolfCMS\Kernel\Modules\App\App;

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand"  href="<?= $app->router->route('index') ?>">WilyCraft</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse wc-background-gradient z-10" id="navbarNavDropdown">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link <?= ($app->requestURI === $app->router->route('index')) ? 'active' : null ?>" aria-current="page" href="<?= $app->router->route('index') ?>">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($app->requestURI === $app->router->route('servers')) ? 'active' : null ?>" href="<?= $app->router->route('servers') ?>">Серверы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($app->requestURI === $app->router->route('rules')) ? 'active' : null ?>" href="<?= $app->router->route('rules') ?>">Правила</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($app->requestURI === $app->router->route('donate')) ? 'active' : null ?>" href="<?= $app->router->route('donate') ?>">Привилегии</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($app->requestURI === $app->router->route('donate')) ? 'active' : null ?>" href="<?= $app->router->route('donate') ?>">Проголосовать</a>
                </li>
                <li class="nav-item dropdown" id="nav_drop">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ссылки
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="nav_drop_menu">
                        <li><a class="dropdown-item" href="https://vk.com/wilycraft" target="_blank">VK</a></li>
                        <li><a class="dropdown-item" href="https://discord.gg/FMd8ySU3q9" target="_blank">Discord</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>