<?php

require_once realpath(__DIR__ . '/vendor/autoload.php');

use PHWolfCMS\App;


$app = new App();

$app->init()
    ->run();


echo '<pre>';
    print_r($app->db->insert('test', array('test' => 5, 'test2' => 6)));
echo '</pre>';