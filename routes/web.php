<?php

use App\Http\Controllers\RunController;
use App\Http\Controllers\SharedFiddleController;
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
Route::post('/run', [RunController::class, '__invoke'])->name('run');

Route::name('shared-fiddles.')->prefix('/shared-fiddles')->group(function () {
    Route::post('/create', [SharedFiddleController::class, 'store'])->name('store');
    Route::get('/{sharedFiddle}', [SharedFiddleController::class, 'show'])->name('show');
});
