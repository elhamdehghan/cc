<?php
//laravel default
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// account control
Route::post('password/mobile','Auth\ForgotPasswordController@sendResetToken');
Route::get('password/token','Auth\ForgotPasswordController@showInputCodeForm');
Route::post('password/token','Auth\ForgotPasswordController@resetPassword');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/acc', 'UserController@acc')->name('acc');
Route::post('/acc', 'UserController@update');

//resource controllers
Route::resource('customers' , 'CustomerController');
