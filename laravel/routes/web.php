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
})->middleware('guest');
//only guests can access these routes
Route::group(['middleware' => ['guest']], function () {
    //Route::post('/signup', 'UsersController@store');
    Route::post('/welcome', 'UsersController@store');
});

Auth::routes();

Route::get('/oauth-clients', 'OauthController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/select-type', 'HomeController@select_type');
Route::get('/save-type/{type}', 'HomeController@save_type');

Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::resource('zeros', 'ZerosController');
Route::resource('ones', 'OnesController');
Route::resource('twos', 'TwosController');

Route::post('/phone/validation', 'ThreesController@submit_validation');
Route::resource('threes', 'ThreesController');
Route::resource('fours', 'FoursController');
Route::resource('fives', 'FivesController');
Route::resource('anonymouses', 'AnonymousesController');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home/facebook', 'FbController@index')->name('fbpage');
//button "login with Fb"
Route::get('/home/facebook/{provider}', 'FbController@loginWithFb');
Route::get('/home/facebook/{provider}/callback', 'FbController@loginWithFbCallback');
//button "unlink Fb"
Route::post('/home/facebook/unlink', 'FbController@unlinkFb')->name('unlink_fb');
//button "Find friends"
Route::get('/home/facebook/friends/{provider}', 'FbController@findFriends');
Route::get('/home/facebook/friends/{provider}/callback', 'FbController@findFriendsCallback');
//button "Remove access to friends"
Route::post('/home/facebook/friends/lock', 'FbController@friendsLock')->name('friendslock');
//button "Add access to photos"
Route::get('/home/facebook/photos/{provider}', 'FbController@getPhotos');
Route::get('/home/facebook/photos/{provider}/callback', 'FbController@getPhotosCallback');
//button "Remove access photos"
Route::post('/home/facebook/photos/lock', 'FbController@lockPhotos')->name('lockPhotos');
//button "Like Facebook page"
Route::post('/home/facebook/like', 'FbController@likeFbPage')->name('like');
///////////////////////////////////////////////////////////////////////
//Reddit page
Route::get('/home/reddit', 'RedditController@index')->name('reddpage');
//button "login with Reddit"
Route::get('/home/reddit/{provider}', 'RedditController@loginWithReddit');
Route::get('/home/reddit/{provider}/callback', 'RedditController@loginWithRediitCallback');
//button "login with Reddit"
Route::get('/home/reddit/{provider}', 'RedditController@loginWithReddit');
Route::get('/home/reddit/{provider}/callback', 'RedditController@loginWithRedditCallback');
//button Unlink Reddit
Route::post('/home/reddit/unlink', 'RedditController@unlinkReddit')->name('unlink_reddit');
/////////////////////////////////////////////////////////////////////////
//Snapchat Story page
Route::get('/home/snapchat', 'SnapchatController@index')->name('snapchat_page');
