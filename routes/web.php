<?php

/**
 * Теперь для маршрутизатора используются именованные маршруты
 * Для создания именного маршрута вместо пути передаётся массив, первый элемент которого - маршрут, второй - имя маршрута
 * Пример: $app->router->get(['/route/{param1}/{param2}/{param3}?', 'testRoute'], $callback);
 * Для генерации URL используется метод $app->router->route($name, $params), где 1 аргумент - имя маршрута, 2 - параметры
 * Пример: $app->router->route('testRoute', [1, 2, 3]) вернёт /route/1/2/3
 * Пример: $app->router->route('testRoute', [1, 2]) вернёт /route/1/2
 */

global $app;

use PHWolfCMS\Http\Controllers\WebController;
use PHWolfCMS\Http\Controllers\AuthController;

$app->router->get(['/', 'index'], [WebController::class, 'getIndex']);
$app->router->get(['/servers', 'servers'], [WebController::class, 'getServers']);
$app->router->get(['/start', 'start'], [WebController::class, 'getStart']);
$app->router->get(['/rules', 'rules'], [WebController::class, 'getRules']);
$app->router->get(['/donate', 'donate'], [WebController::class, 'getDonate']);
$app->router->get(['/vote', 'vote'], [WebController::class, 'getVote']);
$app->router->get(['/skyblock', 'server.skyblock'], [WebController::class, 'getSkyblock']);

$app->router->group(['prefix' => 'cabinet'], function () use ($app) {
    $app->router->get(['/', 'cabinet'], [WebController::class, 'getCabinet']);
    $app->router->get(['/settings', 'cabinet.settings'], [WebController::class, 'getSettings']);
});

$app->router->get(['/registration', 'registration'], [AuthController::class, 'getRegistration']);
$app->router->post(['/registration', 'post.registration'], [AuthController::class, 'postRegistration']);
$app->router->post(['/login', 'post.login'], [AuthController::class, 'postLogin']);
$app->router->get(['/logout', 'logout'], [AuthController::class, 'getLogout']);

$app->router->get('/test', function () {
	global $app;
	var_dump(\PHWolfCMS\Kernel\Modules\Facade\Auth::attempt('Wolf_TMB', 'Wolf_TMB123', '144251'));
});