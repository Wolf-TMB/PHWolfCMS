<?php

namespace PHWolfCMS\Kernel;

class ErrorCatcher {
    /**
     *  Инициализация перехватчика ошибок
     */
    public function __construct() {
        set_error_handler(array($this, 'OtherErrorCatcher'));
        register_shutdown_function(array($this, 'FatalErrorCatcher'));
        ob_start();
    }

    public function OtherErrorCatcher($errno, $errstr): bool {
        return false;
    }

    public function FatalErrorCatcher() {
        $error = error_get_last();
        if (isset($error))
            if ($error['type'] == E_ERROR || $error['type'] == E_PARSE || $error['type'] == E_COMPILE_ERROR || $error['type'] == E_CORE_ERROR) {
                ob_end_clean();
                $file_log = $_SERVER['DOCUMENT_ROOT'] . '/error.log';
                file_put_contents($file_log, PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.'****** ['.date('d.m.y H:m:i', time()).'] ******'.PHP_EOL.PHP_EOL.$error['message'].PHP_EOL, FILE_APPEND | LOCK_EX);
                echo <<<ERR
                    <!doctype html> 
                    <html lang="ru"> 
                        <head> 
                            <meta charset="UTF-8"> 
                            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> 
                            <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
                            <title>Fatal error</title> 
                            <link rel="stylesheet" href="/resources/css/style.css"> 
                        </head> 
                        <body>
                            <div class="container-fluid"> 
                                <div class="p-4" style="z-index: 1000000; background-color: white"> 
                                    <h3>Fatal error! Script is dead</h3> 
                                    <strong>Type</strong>: {$error['type']} <br> 
                                    <strong>Message</strong>: <pre>{$error['message']}</pre> <br> 
                                    <strong>File</strong>: {$error['file']} <br> 
                                    <strong>Line</strong>: {$error['line']} <br> 
                                </div> 
                            </div> 
                        </body> 
                    </html>
                ERR;
            } else {
                ob_end_flush();
            }
        else {
            ob_end_flush();
        }
    }
}