<?php

global $app;

$app->router->get('/', function () {
    global $app;
    $app->render->renderPage(
        'index',
        'main',
        ['title' => 'title']
    );
});

$app->router->get('/test1', [\PHWolfCMS\Http\Controllers\TestController::class, 'getIndex']);
$app->router->post('/test1', [\PHWolfCMS\Http\Controllers\TestController::class, 'postIndex']);