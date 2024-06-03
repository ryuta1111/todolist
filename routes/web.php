<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController; //追記
use App\Http\Controllers\TaskController; //追記
Route::get('/', function () {
    return view('welcome');
});

//Route::get('アドレス , [コントローラー名::class , メソッド名]);
Route::get('/list' , [TodoListController::class,'index']);

Route::resource('/tasks' , TaskController::class);