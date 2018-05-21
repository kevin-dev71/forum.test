<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/forums', 'Api\ForumsController@index');
Route::get('/forums/{forum}', 'Api\ForumsController@show');

Route::get('/posts', 'Api\PostsController@index');
Route::get('/posts/{post}', 'Api\PostsController@show');

