<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
  use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(UserLoginRequest $request)
    {
      //working
      $credentials = $request->validated($request->all());
      if(!Auth()->check($credentials)){
        return response([
          'message'=>'provided Email or Password is incorrect!'
        ]);
      }
      $user = User::where('email', $request->email)->first();

       return response()->json([
         'user'=>$user,
         'token'=>$user->createToken('Api token of'.$user->name)->plainTextToken
       ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UserRegisterRequest $request)
    {
      //working
      $request->validated($request->all());
      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'type'=>$request->type,
        'password'=>Hash::make($request->password)
      ]);
      return response()->json([
        $user,
        'token'=>$user->createToken('ACCESS_TOKEN')->plainTextToken
      ],200);

    }
    public function showUsers(){
      //working
      return User::get()->all();
    }
    public function showUser($id){
      //working
      $user = User::findOrFail($id);
      return $this->success([
        'user'=> $user,

      ]);
    }
    public function logout(Request $request)
    {
      //pending
      $user = $request->user();
      $user->currentAccessToken()->delete();

      return response()->json('Logged Out', 200);
    }
}
