<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'WelcomeController@index')->name("welcome");

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/prueba', function() {
//     var_dump(storage_path('app/public/categories'));
//     $imagen = \App\Helpers\Image::image(storage_path('app/public/categories'), 'CATEGORIA', 'F35144', 850, 350, false);
//     var_dump($imagen);
// });

// Route::get('/phpinfo', function() {
//     phpinfo();
// });

// Route::get('/test-debug', function() {
//     $a = 1;
//     $b = 2;
//     $c = $a + $b;
//     $c++;
//     return 'Hello World c=' . $c;
// });

Route::group(['prefix' => 'courses', 'as' => 'courses.'], function() {
    Route::get('/', 'CourseController@index')->name('index');
    Route::post('/search', 'CourseController@search')->name('search');
});