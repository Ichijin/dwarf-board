<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [IndexController::class, 'index'])->name('login'); //ログイン画面の表示
Route::post('/ajax', [IndexController::class, 'ajax']); //ログインのバリデーション
Route::get('/singup', [IndexController::class, 'singup']);//アカウント新規登録画面の表示
Route::post('/store', [IndexController::class, 'store']);//アカウント新規登録機能

Route::get('/home', [IndexController::class, 'home']); //ホーム画面の表示

Route::get('/userList', [IndexController::class, 'user'])->name('test.show'); //ユーザー管理画面の表示
Route::post('/update', [IndexController::class, 'update']); //ユーザーの編集機能

Route::get('/post', [IndexController::class, 'post']); //新規投稿画面の表示
Route::post('/create', [IndexController::class, 'create']);//新規投稿機能
Route::get('/show', [IndexController::class, 'show'])->name('show');//掲示板（自分だけ）の画面表示
Route::post('/edite', [IndexController::class, 'edite']); //投稿編集画面
Route::post('/destroy', [IndexController::class, 'destroy']); //投稿削除画面
Route::get('/chat', [IndexController::class, 'chat']); //掲示板(4人)
Route::get('/logout', [IndexController::class, 'logout']); //ログアウト

Route::get('/comment', [IndexController::class, 'comment'])->name('comment'); //コメント
Route::get('/commit', [IndexController::class, 'commit']); //コメント機能
Route::post('/delite', [IndexController::class, 'delite']); //コメント削除機能