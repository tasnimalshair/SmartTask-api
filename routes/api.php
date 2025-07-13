<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\Todo\TodoOperationsController;
use App\Http\Controllers\Todo\TodoStatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

## Auth
Route::post('register', [LoginController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [LoginController::class, 'logout']);
    Route::delete('logout-all', [LoginController::class, 'logoutAll']);
});

## Stat
Route::get('todos/stat', [TodoStatController::class, 'index'])->middleware('auth:sanctum');

## Todo
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('todos', TodoController::class);
    Route::put('todos/{id}/ops', [TodoOperationsController::class, 'toggleCompletion']);
});

## Category
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});
