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


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
// urlに名前をつけることができる。/login=login
// https://readouble.com/laravel/6.x/ja/routing.html

Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
// https://laraweb.net/tutorial/9779/
Route::group(['middleware'=>'auth'],function(){

// 投稿内容表示
Route::get('/top','PostsController@index');


// 新規投稿の登録.投稿をコントローラーに送信
Route::post('/save','PostsController@save');

// 更新
Route::put('/top','PostsController@modal')->name('modal');

// 削除
Route::get('/post/{id}/delete','PostsController@delete');


Route::get('/profile/{id}','UsersController@profile')->name('profile');

Route::put('/profile/edit','UsersController@update');

Route::get('/search','UsersController@search');

// ユーザー名検索
Route::post('/research','UsersController@research');
Route::get('/research','UsersController@research');

// https://lull-logbook.com/redmine/issues/2422
// https://qiita.com/mitsu-0720/items/0c2fcdd367e8a6c5999c
// フォローする
Route::get('/follow/{userId}','FollowsController@follow')->name('follow');

// フォローを削除
Route::get('/unfollow/{userId}','FollowsController@unfollow')->name('unfollow');

Route::get('/follow-list','FollowsController@followList');

Route::get('/follower-list','FollowsController@followerList');

Route::get('/logout','Auth\LoginController@logout');
});
