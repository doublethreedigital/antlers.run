<?php
error_reporting(E_ERROR);

use Statamic\View\Antlers\Antlers;

$data = [
    'text' => 'Hello world',
];
$fullTemplate = "{{ text }}";

// Boot Statamic
define('LARAVEL_START', microtime(true));
require __DIR__.'/../statamic/vendor/autoload.php';
$app = require_once __DIR__.'/../statamic/bootstrap/app.php';

$result = (new Antlers)->parse($fullTemplate, $data);
?>

<!doctype html>
<html>
    <head>
        <title>Antlers Fiddle</title>
        <link rel="stylesheet" href="/css/app.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <div id="app">
            <header class="bottom-0 right-0 fixed w-full flex justify-between items-center bg-white shadow-lg">
                <span class="py-3 px-6 font-medium">Antlers Fiddle</span>
                <button class="bg-gray-200 hover:bg-gray-300 py-3 px-8 focus:outline-none">Run</button>
            </header>
            <div class="w-full h-screen flex flex-row">
                <div class="md:w-1/2 h-full">
                    <textarea class="w-full h-full bg-gray-200 p-4 focus:outline-none" name="template" cols="30" rows="10"><?php echo $fullTemplate; ?></textarea>
                </div>
                <div class="md:w-1/2 min-h-full">
                    <div class="bg-gray-900 text-white w-full min-h-full p-4"><?php echo $result; ?></div>
                </div>
            </div>
        </div>
    </body>
</html>
