<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodBankController;
use App\Http\Controllers\PostRequestController;


Route::group(['middleware'=> ['auth:sanctum']], function(){
  Route::get('/ngo/show', [NgoController::class,'show']);//NGO
  Route::get('/showuser/{id}', [AuthController::class,'showUser']);//NGO ADMIN
  Route::delete('/showusers/{id}', [AuthController::class,'destroy']);//NGO ADMIN
  Route::post('/logout', [AuthController::class,'logout']);//USER


  Route::post('/debugtest', [PostRequestController::class,'debugtest']);//USER


  Route::get('/ngo/logout', [NgoController::class,'logout']);//NGO
  Route::apiResource('/food',FoodBankController::class);//USER||ADMIN||NGO
  Route::apiResource('/PostRequest', PostRequestController::class);//NGO
  Route::get('/showusers', [AuthController::class,'showUsers']);//ADMIN
  Route::get('/user',function(Request $request){
    return $request->user()->name;//USER||ADMIN||NGO
  });

});


//User Authentication
Route::post('/register', [AuthController::class,'create']);
Route::post('/login', [AuthController::class,'index']);
//Ngo Authentication
Route::post('/ngo/register', [NgoController::class,'create']);
Route::post('/ngo/login', [NgoController::class,'login']);

