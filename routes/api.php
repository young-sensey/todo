<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login')->name('login');
Route::post('registration', 'AuthController@registration')->name('registration');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::prefix('task')->group(function () {
        Route::post('', 'TaskController@store')->name('task.store');
        Route::put('{task}', 'TaskController@update')->name('task.update');
    });
});
