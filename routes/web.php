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

Route::get('aaa', function () {
    \Artisan::call('storage:link');
});

//admin
Route::get('/admin/login', 'AdminController@adminlogin');
Route::get('/admin/dashboard', 'AdminController@admindashboard');
Route::get('/admin/all_users', 'AdminController@adminall_users');
Route::get('/admin/all_cases', 'AdminController@adminall_cases');
Route::get('/admin/verify_request', 'AdminController@adminverify_request')->name('identity.requests');
Route::get('/admin/verify_profile/{profile}', 'AdminController@adminverify_profile')->name('view.verify.profile.admin');
Route::get('/admin/verified_account', 'AdminController@adminverified_account');
Route::get('/admin/verify/profile/{profile}', 'AdminController@admin_approve_verified_account')->name('update.verify.profile.admin');

Auth::routes();

Route::get('/my/profile', 'UserController@profile')->middleware('auth');
Route::post('/my/profile', 'UserController@storeProfile')->middleware('auth');
Route::post('/verify/identity', 'UserController@storeIdentity')->name('verify.identity')->middleware('auth');
Route::post('/employement/history', 'UserController@storeEmpHistory')->name('employment.history')->middleware('auth');
Route::get('/profile/{user}', 'UserController@showProfile')->name('show.profile')->middleware('auth');
Route::get('/mission/{mission}', 'Main_Ctrl@showMission')->name('single.mission')->middleware('auth');
Route::post('/mission/apply/{mission}', 'Main_Ctrl@applyMission')->name('apply.mission')->middleware('auth');
//country city routes
Route::get('dropdownlist', 'CountryCityController@index');
Route::get('get-state-list', 'CountryCityController@getStateList');
Route::get('get-city-list', 'CountryCityController@getCityList');
Route::post('getoffer', 'AjaxController@getOffer');
Route::get('pay/bitcoin', 'BitCoinController@index')->name('pay.bitcoin');
Route::get('pcoingate/cancel', function () {
    dd('cancelled');
});

Route::get('pcoingate/success', 'OrderController@success');

Route::get('browse-mission', 'Freelancer\FreelancerController@browsemission')->name('browse-mission')->middleware('auth');
Route::get('personal', 'Freelancer\FreelancerController@personal')->name('personal')->middleware('auth');
Route::get('source', 'Employer\EmployerController@source')->name('source')->middleware('auth');
Route::get('settings', 'Main_Ctrl@settings')->name('settings')->middleware('auth');
Route::post('settings', 'Main_Ctrl@postsettings')->name('settings.store')->middleware('auth');
Route::get('search', 'Main_Ctrl@search')->name('search.browsemission')->middleware('auth');
Route::post('withdraw', 'Main_Ctrl@withdraw')->name('withdraw.post')->middleware('auth');
Route::get('withdraw', 'AdminController@withdrawRequests')->name('withdraw.requests')->middleware('auth');
Route::get('withdraw/accept/{id}', 'AdminController@acceptWithdrawRequest')->middleware('auth');
Route::get('withdraw/reject/{id}', 'AdminController@rejectWithdrawRequest')->middleware('auth');

//bookmarks
Route::post('bookmark', 'BookmarkController@bookmark')->name('bookmark');
Route::post('unbookmark', 'BookmarkController@unbookmark')->name('unbookmark');
Route::get('/delete/bookmark/{id}', 'BookmarkController@deleteBookmark')->name('bookmark.delete');

Route::post('sourcebookmark', 'BookmarkController@sourceBookmark')->name('source.bookmark');
Route::post('sourceunbookmark', 'BookmarkController@sourceUnbookmark')->name('source.unbookmark');
Route::get('/delete/sourcebookmark/{id}', 'BookmarkController@deleteSourceBookmark')->name('source.bookmark.delete');

// messenger

Route::prefix('messenger')->group(function () {
    Route::get('/', 'MessageController@defaultLaravelMessenger')->name('default.messenger');
    Route::get('t/{id}', 'MessageController@laravelMessenger')->name('messenger');
    Route::post('send', 'MessageController@store')->name('message.store');
    Route::get('threads', 'MessageController@loadThreads')->name('threads');
    Route::get('more/messages', 'MessageController@moreMessages')->name('more.messages');
    Route::delete('delete/{id}', 'MessageController@destroy')->name('delete');
    // AJAX requests.
    Route::prefix('ajax')->group(function () {
        Route::post('make-seen', 'MessageController@makeSeen')->name('make-seen');
    });
});

Route::prefix('messenger')->group(function () {
// Route::get('/', 'MessageController@defaultLaravelMessenger')->name('default.messenger');
    Route::get('group_chat', 'MessageController@showgroupchat')->name('groupmessenger');
    Route::post('send', 'MessageController@store')->name('message.store');
// Route::get('threads', 'MessageController@loadThreads')->name('threads');
    // Route::get('more/messages', 'MessageController@moreMessages')->name('more.messages');
    // Route::delete('delete/{id}', 'MessageController@destroy')->name('delete');
    // AJAX requests.
    // Route::prefix('ajax')->group(function () {
    // Route::post('make-seen', 'MessageController@makeSeen')->name('make-seen');
    // });
});