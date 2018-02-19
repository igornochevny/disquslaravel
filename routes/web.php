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

use Illuminate\Http\Request;


Auth::routes();

Route::get('/', 'BlogController@index');


Route::group(['middleware' => 'auth'], function () {

    Route::resource('blog', 'BlogController');

    Route::resource('comment', 'CommentController', ['only' => ['update', 'destroy']]);

    Route::post('comment/create/{post}', 'CommentController@addPostComment')->name('postcomment.store');

    Route::post('reply/create/{comment}', 'CommentController@addReplyComment')->name('replycomment.store');

});