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


Route::group(['middleware'=>'auth'],function(){

Route::get('/', function () {
    return view('welcome');
});

Route::resource('box','BoxController');

Route::get('box-list','BoxController@boxList');

Route::resource('folder','FolderController');

Route::get('folder-list','FolderController@folderList');

Route::get('find-folder/{box_id}','FolderController@findFolder');


Route::resource('file','FileController');

Route::get('file-list','FileController@fileList');

Route::get('find-file/{folder_id}','FileController@findFile');



Route::resource('document','DocumentController');

Route::get('logout','GeneralController@logout');





});

Route::get('auth/facebook', 'FacebookController@redirectToFacebook');

Route::get('auth/facebook/callback', 'FacebookController@handleFacebookCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
