<?php

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

Route::get('/verifyOTP','VerifyOTPController@showVerifyForm');
Route::post('/verifyOTP','VerifyOTPController@verify');
Route::post('/resend_otp','ResendOTPController@resend');

Route::get('/students/generate', 'UsersController@generateFakeStudents');
Route::get('/candidates/generate', 'CandidatesController@generateCandidates');

Route::get('/students/dashboard', 'UsersController@dashboard');

Route::get('/admin/login', 'Auth\AdminLoginController@showAdminLoginForm');
Route::post('/admin/login', 'Auth\AdminLoginController@adminLogin');

Route::get('/admin/home', 'AdminsController@index')->name('admin.home');
Route::get('/admin/openvote', 'AdminsController@openVote');
Route::get('/admin/closevote', 'AdminsController@closeVote');

Route::get('/votes/view/{id}', 'VotesController@show');
Route::post('/votes/cast', 'VotesController@castVotes');
Route::get('/votes/prepare', 'VotesController@prepareVotesDB');
Route::get('/votes/generate', 'VotesController@generateRandomVotes');
Route::get('/votes', 'VotesController@index');

Route::resource('candidates', 'CandidatesController');
Route::resource('students', 'UsersController');

Route::group(['middleware' => 'TwoFA' ] , function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('/user/logout', 'Auth\LoginController@logout')->name('user.logout');
});

Auth::routes();
