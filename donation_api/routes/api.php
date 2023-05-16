<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodBankController;
use App\Http\Controllers\PostRequestController;


Route::group(['middleware'=> ['auth:sanctum']], function(){
  Route::get('/ngo/show', [NgoController::class,'show']);
  Route::get('/showuser/{id}', [AuthController::class,'showUser']);
  Route::post('/logout', [AuthController::class,'logout']);
  Route::get('/ngo/logout', [NgoController::class,'logout']);
  Route::apiResource('/food',FoodBankController::class);
  Route::apiResource('/PostRequest', PostRequestController::class);
  Route::get('/showusers', [AuthController::class,'showUsers']);
  Route::get('/user',function(Request $request){
    return $request->user()->name;
  });

});


//User Authentication
Route::post('/register', [AuthController::class,'create']);
Route::post('/login', [AuthController::class,'index']);
//Ngo Authentication
Route::post('/ngo/register', [NgoController::class,'create']);
Route::post('/ngo/login', [NgoController::class,'login']);

