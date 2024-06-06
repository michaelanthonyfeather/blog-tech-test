<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', 'App\Http\Controllers\PostController@index')->name('blog.index');
Route::get('/search', 'App\Http\Controllers\PostController@search')->name('blog.search');
Route::get('/posts/{post:slug}', 'App\Http\Controllers\PostController@show')->name('blog.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/posts', 'App\Http\Controllers\PostController@store')->name('blog.store');
    Route::post('/posts/like', 'App\Http\Controllers\PostController@like');
});
