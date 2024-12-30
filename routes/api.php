<?php

use App\Http\Controllers\StudyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/signup' , [UserController::class , "signup"]);
Route::post('/login' , [UserController::class , "login"]);

Route::post('/study' , [StudyController::class , "createStudyData"]);




