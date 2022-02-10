<?php

global $app;

use PHWolfCMS\Http\Controllers\WebController;
use PHWolfCMS\Http\Controllers\AuthController;

$app->router->get('/', [WebController::class, 'getIndex']);
$app->router->get('/servers', [WebController::class, 'getServers']);
$app->router->get('/start', [WebController::class, 'getStart']);
$app->router->get('/rules', [WebController::class, 'getRules']);
$app->router->get('/donate', [WebController::class, 'getDonate']);
$app->router->get('/vote', [WebController::class, 'getVote']);

$app->router->get('/login', [AuthController::class, 'getLogin']);
$app->router->post('/login', [AuthController::class, 'postLogin']);
$app->router->get('/register', [AuthController::class, 'getRegister']);
$app->router->post('/register', [AuthControler::class, 'postRegister']);
$app->router->get('/test', function () {
    global $app;
    $app->render->renderPage(
        'index',
        'main',
        ['title' => 'title']
    );
});