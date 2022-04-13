<?php

global $app;

use PHWolfCMS\Http\Controllers\Admin\AdminController;

$app->router->group(['prefix' => 'admin', 'before' => 'require_auth'], function () use ($app) {
    $app->router->get(['/', 'admin.index'], [AdminController::class, 'getIndex'], [], ['a_adminpanel_access']);
});