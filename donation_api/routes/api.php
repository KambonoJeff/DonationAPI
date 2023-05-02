<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodBankController;
use App\Http\Controllers\PostRequestController;


Route::group(['middleware'=> ['auth:sanctum']], function(){
  Route::get('/showusers', [AuthController::class,'showUsers']);
  Route::get('/ngo/show', [NgoController::class,'show']);
  Route::get('/showuser/{id}', [AuthController::class,'showUser']);
  Route::get('/logout/{$id}', [AuthController::class,'logout']);
  Route::get('/ngo/logout', [NgoController::class,'logout']);
  Route::apiResource('/food',FoodBankController::class);
  Route::apiResource('/PostRequest', PostRequestController::class);


});

//User Authentication
Route::post('/register', [AuthController::class,'create']);
Route::post('/login', [AuthController::class,'index']);
//Ngo Authentication
Route::post('/ngo/register', [NgoController::class,'create']);
Route::post('/ngo/login', [NgoController::class,'login']);

