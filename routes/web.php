<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get(
    '/home',
    [HomeController::class, 'index']
)->name('home');

$groupData = [
    'prefix' => 'senior',
    'as' => 'senior.',
    'middleware' => 'auth',
];

Route::group($groupData, function () {
    Route::resource('users', UserController::class);
});

