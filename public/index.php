<?php

use Statamic\View\Antlers\Antlers;

$data = [
    'text' => 'Hello world',
];
$fullTemplate = "{{ dump }}";

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
    </head>
    <body>
        <textarea cols="30" rows="20"><?php echo $fullTemplate; ?></textarea>
        <div style="background: black; color: white; padding: 1rem;">
            <?php echo $result; ?>
        </div>
    </body>
</html>
