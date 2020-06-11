<?php

/*
|--------------------------------------------------------------------------
| Freelancer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register freelancer routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['prefix' => 'freelancer'], function () {
    Route::get('/register', 'FreelancerController@showRegister');

    Route::get('dashboard', 'FreelancerController@dashboard')->name('freelancer.dashboard')->middleware('auth');
    Route::get('my-jobs', 'FreelancerController@myJobs')->name('freelancer.myjobs')->middleware('auth');

    Route::get('messages', 'FreelancerController@messages')->name('messages')->middleware('auth');
    Route::get('saved', 'FreelancerController@saved')->name('saved')->middleware('auth');
    Route::get('settings', 'FreelancerController@settings')->name('settings')->middleware('auth');
    // Route::get('group_chat', 'FreelancerController@group_chat')->name('group_chat')->middleware('auth');

    Route::get('balance', 'FreelancerController@balance')->name('balance')->middleware('auth');

    Route::get('crowdfund', 'FreelancerController@crowdfund')->name('crowdfund')->middleware('auth');

    Route::get('participated', 'FreelancerController@participated')->name('group_chat')->middleware('auth'); //this page is on coming soon

    Route::post('submit/work', 'FreelancerController@submitwork')->name('submit.work');

});
