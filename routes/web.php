<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth', 'AuthController@auth')->name('auth-view');
Route::get('registrationView', 'AuthController@registrationView')->name('registration-view');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::prefix('task')->group(function () {
        Route::get('', 'TaskController@index')->name('task.index');
        Route::get('create', 'TaskController@create')->name('task.create');
        Route::get('{task}/edit', 'TaskController@edit')->name('task.edit');
    });
});
