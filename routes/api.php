<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkshopController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('adminRegister','adminRegister');
    Route::post('instructorRegister','instructorRegister');
    Route::post('educatorsRegister','educatorsRegister');
    Route::patch('updateinstructor','updateinstructor');
    Route::post('updateeducators','updateeducators');
    Route::get('logout','logout');
});

Route::controller(WorkshopController::class)->group(function(){
    Route::post('scriptworkshop','scriptworkshop');
    Route::post('createworkshop','createworkshop');
});
