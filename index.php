<?php

require_once realpath(__DIR__ . '/vendor/autoload.php');

use PHWolfCMS\App;

$app = new App();

$app->preInit()
    ->init()
    ->run();
