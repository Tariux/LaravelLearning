<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoListController;
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

Route::get('/debug/{name?}', function ($name = 'Quest') { return view('debug' ,['name' => $name] );});


Route::resource('/todo' , TodoListController::class);
//Route::delete('/todo/{id}', 'TodoListController@destory');

Route::post('/update_todo_done',[TodoListController::class, 'update']);
Route::post('/delete_todo',[TodoListController::class, 'destroy']);


Route::resource('register' , RegisterController::class);

Route::resource('login' , LoginController::class);

Route::post('check', [LoginController::class, 'doLogin'])->name('do.login');

Route::get('logout', [LoginController::class, 'logout'])->name('do.logout');