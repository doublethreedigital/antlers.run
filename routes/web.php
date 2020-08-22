<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    $parse = (new \Statamic\View\Antlers\Parser)->parse(
        $request->template, \Symfony\Component\Yaml\Yaml::parse($request->frontMatter)
    );

    return [
        'result' => (string) $parse
    ];
});
