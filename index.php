<?php
$timeStart = hrtime(true);

require_once realpath(__DIR__ . '/vendor/autoload.php');

use PHWolfCMS\App;

$app = new App();

$app->preInit()
    ->init()
    ->run();

$timeEnd = hrtime(true);

$executeTime = ($timeEnd - $timeStart) / 1e+6;

$URIData = explode('/', rtrim(ltrim($app->requestURI,'/'), '/'));
if ($URIData[0] != $app->config->get('ROUTER_API_PREFIX')) {
    echo '
        <div style="background-color: black; color: white; position: fixed; top: 0; right: 0; padding: 4px; z-index: 99999;">
            '. $executeTime .' ms
        </div>
    ';
}