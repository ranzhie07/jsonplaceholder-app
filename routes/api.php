<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotosController;


Route::middleware('auth.basic')->get('/users', [UsersController::class, 'index']);
Route::middleware('auth.basic')->get('/posts', [PostsController::class, 'index']);
Route::middleware('auth.basic')->get('/comments', [CommentsController::class, 'index']);
Route::middleware('auth.basic')->get('/todos', [TodosController::class, 'index']);
Route::middleware('auth.basic')->get('/albums', [AlbumsController::class, 'index']);
Route::middleware('auth.basic')->get('/photos', [PhotosController::class, 'index']);

//show data
Route::middleware('auth.basic')->get('/posts/{id}', [PostsController::class, 'show']);
Route::middleware('auth.basic')->get('/comments/{id}', [CommentsController::class, 'show']);
Route::middleware('auth.basic')->get('/albums/{id}', [AlbumsController::class, 'show']);
Route::middleware('auth.basic')->get('/photos/{id}', [PhotosController::class, 'show']);
Route::middleware('auth.basic')->get('/todos/{id}', [TodosController::class, 'show']);
Route::middleware('auth.basic')->get('/users/{id}', [UsersController::class, 'show']);

Route::middleware('auth.basic')->get('/posts/{id}/comments', [PostsController::class, 'comments']);

//store data
Route::middleware('auth.basic')->post('/posts', [PostsController::class, 'store']);

//update
Route::middleware('auth.basic')->put('/posts/{id}', [PostsController::class, 'update']);
Route::middleware('auth.basic')->patch('/posts/{id}', [PostsController::class, 'patch']);
Route::middleware('auth.basic')->delete('/posts/{id}', [PostsController::class, 'destroy']);
