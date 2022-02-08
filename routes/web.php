<?php

global $app;

use PHWolfCMS\Http\Controllers\WebController;
use PHWolfCMS\Http\Controllers\AuthController;

$app->router->get('/', [WebController::class, 'getIndex']);

$app->router->get('/login', [AuthController::class, 'getLogin']);
$app->router->post('/login', [AuthController::class, 'postLogin']);
$app->router->get('/register', [AuthController::class, 'getRegister']);
$app->router->post('/register', [AuthController::class, 'postRegister']);
$app->router->get('/test', function () {
    global $app;
    $app->render->renderPage(
        'index',
        'main',
        ['title' => 'title']
    );
});

$app->router->get('/servers', function () {
    global $app;
    $app->render->renderPage(
        'servers',
        'main',
        ['title' => 'WilyCraft Servers']
    );
});
$app->router->get('/start', function () {
    global $app;
    $app->render->renderPage(
        'start',
        'main',
        ['title' => 'WilyCraft Servers']
    );
});