<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodBankController;
use App\Http\Controllers\PostRequestController;


Route::group(['middleware'=> ['auth:sanctum']], function(){
  Route::get('/ngo/show', [NgoController::class,'show']);//NGO
  Route::post('/ngo/update/{id}', [NgoController::class,'update']);//NGO
  Route::get('/showngo/{id}', [NgoController::class,'showNgo']);//NGO
  Route::delete('/ngo/delete/{id}', [NgoController::class,'destroy']);//NGO
  Route::get('/showoneuser/{id}', [AuthController::class,'showUser']);//NGO ADMIN
  Route::delete('/showusers/{id}', [AuthController::class,'destroy']);//NGO ADMIN
  Route::post('/logout', [AuthController::class,'logout']);//USER
  Route::post('/edit/user/{id}', [AuthController::class,'update']);//USER
  Route::post('/debugtest', [PostRequestController::class,'debugtest']);//USER
  Route::get('/requests/compare', [PostRequestController::class,'compare']);//USER
  Route::get('/requests/diffrence', [PostRequestController::class,'diffrence']);//USER
  Route::get('/requests/{id}',[PostRequestController::class,'show']);
  Route::get('/ngo/logout', [NgoController::class,'logout']);//NGO
  Route::get('/sumfood', [FoodBankController::class,'sumall']);//NGO
  Route::delete('/food/delete/{id}', [FoodBankController::class,'destroy']);//NGO
  Route::get('/showusers', [AuthController::class,'showUsers']);//ADMIN
  Route::get('/user',function(Request $request){
    return $request->user()->name;//USER||ADMIN||NGO
  });
  Route::get('/PostRequest',[PostRequestController::class,'index']);
  Route::post('/PostRequest/{id}', [PostRequestController::class,'update']);
  Route::post('/food/update/{id}', [FoodBankController::class,'update']);//NGO
  Route::get('/food', [FoodBankController::class,'index']);//NGO
  Route::post('/food', [FoodBankController::class,'store']);//NGO
  Route::get('/food/{id}', [FoodBankController::class,'show']);//NGO

  Route::delete('/PostRequest/{id}',[PostRequestController::class,'destroy']);
});


//User Authentication
Route::post('/register', [AuthController::class,'create']);
Route::post('/login', [AuthController::class,'index']);
//Ngo Authentication
Route::post('/ngo/register', [NgoController::class,'create']);
Route::post('/ngo/login', [NgoController::class,'login']);

Route::group(['middleware'=> ['auth:sanctum']], function(){




});
Route::post('/admin/login',[AdminController::class,'index'])->name('admin');
Route::post('/admin/register',[AdminController::class,'create'])->name('adminregister');
