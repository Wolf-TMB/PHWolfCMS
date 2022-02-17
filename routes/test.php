<?php
/**
 * @var App $app
 */

use PHWolfCMS\App;

$app->router->get('/test2', function () {
    global $app;
    $r = new \PHWolfCMS\Kernel\FileRepositories\TestFileRepository('1');
    echo '<pre>';
        print_r($r);
    echo '</pre>';
});