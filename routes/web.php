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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=> true]);

Route::get('movie','getData@getMovie')->name('movie');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::view('/profile','profile')->middleware('auth');
Route::post('update','updatePasswordController@update');
Route::post('profile','UserController@update_avatar');
Route::post('profile_edit','UserController@profile_edit')->name('profile_edit');
Route::get('watch/{id}','WatchController@watchMovie')->middleware('auth');

// BOARD ROUTE
Route::get('/freeboard','postController@freeboard')->name('freeboard');
Route::get('freeboard/{id}','postController@freeboardView');
Route::get('/qna','postController@qna')->name('qna');
Route::get('/notice/{id}','postController@noticeView');

//POSTING ROUTE
Route::get('/post/freeboardPost','postController@freeboardPost')->name('post.freeboardPost')->middleware('auth');
Route::post('/post/freeboardPosting','postController@freeboardPosting')->name('post.freeboardPosting')->middleware('auth');
Route::post('/post/upload_image','postController@upload_image')->name('post.upload_image')->middleware('auth');
//DELETE POST
Route::get('/freeboard/post/del/{id}','postController@del_post')->middleware('auth');

Route::get('/post/edit/{id}','postController@edit')->middleware('auth');
Route::post('/post/edit/freeboardEditing','postController@freeboardEditing')->name('post.edit.freeboardEditing')->middleware('auth');

Route::get('/notice/edit/{id}','postController@noticeEdit')->middleware('admin');
Route::post('/notice/edit/noticeEditing','postController@noticeEditing')->name('notice.edit.noticeEditing')->middleware('auth');
Route::get('/notice/del/{id}','postController@del_notice')->middleware('admin');
// ADMIN ROUTE
Route::get('/admin','adminController@index')->middleware('admin')->name('admin');
Route::view('/admin/movie_upload','admin.movie_upload')->middleware('admin')->name('admin.movie_upload');
Route::post('upload_movie','MovieController@upload')->middleware('admin')->name('upload_movie');
Route::get('admin.board_notice','adminController@board_notice')->middleware('admin')->name('admin.board_notice');
Route::post('admin.board_notice_upload','adminController@board_notice_upload')->middleware('admin')->name('admin.board_notice_upload');
