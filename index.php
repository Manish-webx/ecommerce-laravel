<?php

// $uri = urldecode(
//     parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
// );

// if($uri !== '/' && file_exists(__DIR__.'/public'.$uri)){
//    return false;
// };

// require_once __DIR__.'/public/index.php';


define('LARAVEL_START', microtime(true));

// Point Laravel to the REAL public directory
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/public';

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);