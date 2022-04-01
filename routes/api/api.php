<?php

global $app;


use PHWolfCMS\Http\Controllers\ApiController;
use PHWolfCMS\Http\Controllers\API\UserController;

$app->router->group(['prefix' => 'api'], function () use ($app) {
    $app->router->get('/', [ApiController::class, 'getIndex']);

    $app->router->group(['prefix' => 'user'], function () use ($app) {
        $app->router->get('{login}/auth/{password}', [UserController::class, 'getAuth']);
        $app->router->get('{login}/skin/get', [UserController::class, 'getSkinGet']);
        $app->router->get('{login}/cloak/get', [UserController::class, 'getCloakGet']);
    });
});