<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotosController;

Route::get('/', function () {
    return view('welcome');
});
