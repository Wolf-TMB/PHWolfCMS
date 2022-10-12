<?php
/**
 * @var App $app
 */

use PHWolfCMS\Models\User;
use PHWolfCMS\Kernel\Modules\App\App;
use PHWolfCMS\Kernel\Modules\FileRepository\SkinFileRepository;

$app->router->get('/test2', function () {
    global $app;
    /*$app->html->form()
        ->action('/test2')
        ->method('POST')
        ->enctype('multipart/form-data')
        ->inputFile('file', 'file')
        ->button('Send')
        ->print();*/

    $auth = new \PHWolfCMS\Kernel\Modules\Facade\Auth();
    //var_dump(\PHWolfCMS\Kernel\Modules\Facade\Auth::logout());
    //var_dump(\PHWolfCMS\Kernel\Modules\Facade\Auth::attempt('Wolf_TMB', 'WolfTMB123'));
    //$user = User::find(1);
    /** @var SkinFileRepository $repo */
    $repo = (new \PHWolfCMS\Kernel\Modules\FileRepository\FileRepository())->get('skin');
    $f = $repo->getByLogin('Wolf_TMB');
    echo '<pre>';
        print_r($f->getPath());
    echo '</pre>'; 1 1
});
$app->router->post('/test2', function () {
    global $app;
});