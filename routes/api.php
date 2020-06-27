<?php

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

Route::get('/all-tasks', 'TasksController@index');
Route::post('/save-task', 'TasksController@save');
Route::post('/finished-task', 'TasksController@finished');
Route::post('/finished-all-tasks', 'TasksController@finishedAll');
Route::post('/delete-all-finished-tasks', 'TasksController@deleteAllFinished');
