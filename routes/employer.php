<?php

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register employer routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['prefix' => 'employer'], function () {

    Route::get('/register', 'EmployerController@showRegister');

    Route::get('dashboard', 'EmployerController@dashboard')->name('employer.dashboard');
    Route::get('upload-mission', 'EmployerController@uploadMission')->name('upload-mission');
    Route::post('upload-mission', 'EmployerController@postMission')->name('post.upload-mission');

    Route::get('messages', 'EmployerController@messages')->name('messages');
    Route::get('saved', 'EmployerController@saved')->name('saved');
    //  Route::get('personal','EmployerController@personal')->name('personal');

    Route::get('group_chat', 'EmployerController@group_chat')->name('group_chat');

    Route::get('view_offer', 'EmployerController@view_offer')->name('view_offer');

    Route::get('balance', 'EmployerController@balance')->name('balance');
    Route::get('crowdfund', 'EmployerController@crowdfund')->name('crowdfund');

    Route::get('participated', 'EmployerController@participated')->name('participated'); //This page is coming soon

    Route::post('accept-work', 'EmployerController@acceptWork')->name('accept-work');
    Route::get('my-orders', 'EmployerController@myOrders')->name('employer.myorders');

});
