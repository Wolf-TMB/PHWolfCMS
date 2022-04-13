<?php

global $app;

$app->router->filter('require_auth', function () use ($app) {
    if (!\PHWolfCMS\Kernel\Modules\Facade\Auth::check()) $app->router->redirect('/');
});