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
$app->router->get('/cabinet', [WebController::class, 'getCabinet']);
$app->router->get('/settings', [WebController::class, 'getSettings']);
$app->router->get('/registration', [AuthController::class, 'getRegistration']);
$app->router->post('/registration', [AuthController::class, 'postRegistration']);

$app->router->get('/test', function () {
    global $app;
    $app->render->renderPage(
        'index',
        'main',
        ['title' => 'title']
    );
});