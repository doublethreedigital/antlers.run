<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;
use Statamic\View\Antlers\Engine;
use Statamic\View\Antlers\Parser;
use Statamic\Yaml\Yaml;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'app');
Route::view('/statamic-home', 'statamic-home');

Route::post('/submit', function (Request $request) {
    $requestId = Uuid::uuid6();

    $requestViewPath = resource_path('views/'.$requestId.'.antlers.html');
    $requestViewContents = '---'.PHP_EOL.$request->frontMatter.PHP_EOL.'---'.PHP_EOL.$request->template;

    File::put($requestViewPath, $requestViewContents);

    $data = array_merge(\Symfony\Component\Yaml\Yaml::parse($request->frontMatter), [
        'current_date' => $now = now(),
        'now' => $now,
        'today' => $now,
    ]);

    return view($requestId, $data)->render();
});
