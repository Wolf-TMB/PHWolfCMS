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

$app->router->get('/test1', function () use ($app) {
    $app->session->setFlash('testFlash', 'text');
});

$app->router->get('/test2', function () use ($app) {
    echo '<pre>';
        print_r($_SESSION);
    echo '</pre>';
});

$app->router->get('/test3', function () use ($app) {
    var_dump($app->session->getFlash('testFlash'));
});