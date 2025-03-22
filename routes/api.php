<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

#Log-info
Route::get('/log-api', [LogController::class, 'getData']);

#Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/userLogin', [AuthController::class, 'userLogin'])->middleware(['auth:sanctum']);

#Post Features
Route::get('/posts', [PostController::class, 'index'])->middleware(['auth:sanctum']); 
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware(['auth:sanctum']); 

