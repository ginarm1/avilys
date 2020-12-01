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

Route::get('/', 'PagesController@index');
Route::get('/', 'PermitsController@show');

// Mobiliuju rysiu planai [rodomi neprisijungus]
Route::resource('planai','PlansController');
Route::resource('uzsakymas','OrdersController');
// Registracija ir prisijungimas
Auth::routes();

Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

Route::get('/ataskaita', 'ReportsController@index');
Route::get('/ataskaita/klientai', 'ReportsController@clients');
Route::get('/ataskaita/uzsakymai', 'ReportsController@orders');
Route::get('/ataskaita/vadybininkai', 'ReportsController@managers');
Route::get('/ataskaita/admins', 'ReportsController@admins');
Route::get('/ataskaita/planai', 'ReportsController@plans');

// Sending emails
Route::get('/email', 'EmailsController@index');

//Route::post('password/email', 'ForgotPasswordController@forgot');
//Route::post('password/reset', 'ForgotPasswordController@reset');
//Route::view('forgot_password', 'auth.reset_password')->name('password.reset');
