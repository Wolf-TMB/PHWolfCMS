<?php

global $app;


use PHWolfCMS\Http\Controllers\API\LogsController;
use PHWolfCMS\Http\Controllers\ApiController;
use PHWolfCMS\Http\Controllers\API\UserController;
use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

$app->router->group(['prefix' => 'api'], function () use ($app) {
    $app->router->get('/', [ApiController::class, 'getIndex']);

    $app->router->group(['prefix' => 'user'], function () use ($app) {
        $app->router->get('{login}/auth/{password}/{code2fa}?', [UserController::class, 'getAuth']);
        $app->router->get('{login}/skin/get', [UserController::class, 'getSkinGet']);
        $app->router->get('{login}/skin/preview/get', [UserController::class, 'getSkinPreviewGet']);
        $app->router->get('{login}/skin/head/get', [UserController::class, 'getSkinHeadGet']);
        $app->router->get('{login}/cloak/get', [UserController::class, 'getCloakGet']);
    });

	$app->router->group(['prefix' => 'logs'], function () use ($app) {
		$app->router->get(['/{userid:i}/{action:[a-z]+}/{from:i}/{count:i}/get', 'testApi'], [LogsController::class, 'getUseridActionPageGet']);
	});

	$app->router->get('/test', function () {
		global $app;
	});
	$app->router->post('/test', function () {
		$code = $_POST['code'];
		echo '<pre>';
		    print_r($code);
		echo '</pre>';
		$ga = new GoogleAuthenticator(8, 25);
		var_dump($ga->checkCode('TVQRXBSSMKGYCZ4FJYWVSE6JND3NZSO3TO2YT5QL', $code));
		echo '<pre>';
		    print_r($ga->getCode('TVQRXBSSMKGYCZ4FJYWVSE6JND3NZSO3TO2YT5QL', new DateTime()));
		echo '</pre>';
	});
});