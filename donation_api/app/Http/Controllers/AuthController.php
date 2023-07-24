<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
  use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      //working
     $data = $request->validate([
        'email'=>['required','email'],
        'password'=>['required','min:8'],
     ]);
     if($data){
      $email = $request->email;
      $pass = $request->password;
      $check = User::where('email',$email)->first();
      if(!$check){
        return response()->json([
          'message'=>'Credentials do not match'
        ]);
      }
      if(!Hash::check($pass , $check->password)){
        return response()->json([
          'message'=>'Credentials do not match'
        ]);
      }else{
        return response()->json([
          $check,
        'type'=>'user',

        'token'=>$check->createToken('ACCESS_TOKEN')->plainTextToken
        ]);
      }


     }

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
        'type'=>'admin'
,
        'token'=>$user->createToken('ACCESS_TOKEN')->plainTextToken
      ],200);

    }
    public function showUsers(){
      //working
      return User::query()->orderBy('id','desc')->paginate(4);
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
    public function destroy(Request $request){
      $data = User::FindOrFail($request->id);
      $data->delete();
      return response()->json('',204);
    }
}
