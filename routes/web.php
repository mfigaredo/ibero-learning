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

Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['teacher']], function() {
    Route::get('/', 'TeacherController@index')->name('index');
    /**
     * COURSE Routes
     */
    Route::get('/courses', 'TeacherController@courses')->name('courses');
    Route::get('/courses/create', 'TeacherController@createCourse')->name('courses.create');
    Route::get('/courses/update', 'TeacherController@updateCourse')->name('courses.update');
    /**
     * UNIT Routes
     */
    Route::get('/units', 'TeacherController@units')->name('units');
    Route::get('/units/create', 'TeacherController@createUnit')->name('units.create');
    Route::post('/units/store', 'TeacherController@storeUnit')->name('units.store');
    /**
     * COUPON Routes
     */
    Route::get('/coupons', 'TeacherController@index')->name('coupons');

});