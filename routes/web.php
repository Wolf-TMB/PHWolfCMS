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