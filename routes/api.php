<?php

use App\Http\Controllers\StudyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/signup', [UserController::class, "signup"]);
Route::post('/login', [UserController::class, "login"]);




Route::group(['middleware' => "auth:sanctum"], function () {

    Route::post('/study', [StudyController::class, "createStudyData"]);
    Route::get('/users', [UserController::class, "getUsersDetails"]);
    Route::get('/user/{id}', [UserController::class, "getUserDetails"]);
    Route::put('/user/{id}', [UserController::class, "UpdateUserDetails"]);
    Route::delete('/user/{id}', [UserController::class, "deleteUserDetails"]);
});

// Route::post('/login', [UserController::class, "login"])->name("login");