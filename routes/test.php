<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

$app->router->get('/test2', function () {
    global $app;
    $app->html->form()
        ->action('/test2')
        ->method('POST')
        ->enctype('multipart/form-data')
        ->inputFile('file', 'file')
        ->button('Send')
        ->print();
});
$app->router->post('/test2', function () {
    global $app;
    $repo = new \PHWolfCMS\Kernel\FileRepositories\TestFileRepository('test');
    $repo->upload($_FILES['file']);
});