<?php

use App\Task;
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

Route::get('/pusher', function () {
    //App\Events\EventSocket::dispatch("Cesar");
});

Route::get('/notify/{user}', 'HomeController@notify');
Route::get('/room/{id}', 'HomeController@room');

Route::get('/tasks', function () {
    return Task::all()->pluck('name');    
});

Route::post('/task', function (Request $request) {
    $task = Task::create(request()->all());

    App\Events\EventSocket::dispatch($task);

    return $task;
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
    //
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
