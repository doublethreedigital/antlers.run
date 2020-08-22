<?php

define('STATAMIC_PATH', __DIR__.'/../statamic');

/**
 * Boot the Statamic application.
 */
error_reporting(E_ERROR);
define('LARAVEL_START', microtime(true));
require STATAMIC_PATH.'/vendor/autoload.php';
$app = require_once STATAMIC_PATH.'/bootstrap/app.php';

/**
 * Route requests to the correct places.
 */
$requestId = uniqid();
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$body = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET' && $path === '/') {
    require __DIR__.'/../src/views/front-end.php';
} elseif ($method === 'GET' && $path === '/statamic-home') {
    require __DIR__.'/../src/views/statamic-home.php';
} elseif ($method === 'POST' && $path === '/submit') {
    $parse = (new \Statamic\View\Antlers\Parser)->parse(
        $body['template'], \Symfony\Component\Yaml\Yaml::parse($body['frontMatter'])
    );

    echo json_encode([
        'result' => (string) $parse,
    ]);
} else {
    http_response_code(404);
    echo 'Uh oh... nothing found here me hartes. <br>';
    echo '<a href="/">Go Home</a>';
}

return;
?>
