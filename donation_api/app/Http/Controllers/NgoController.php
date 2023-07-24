<?php

namespace App\Http\Controllers;

use App\Models\Ngo;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreNgoRequest;

class NgoController extends Controller
{
  use HttpResponses;
  //Registers a new Ngo
  //working
    public function create(StoreNgoRequest $request)
    {
      $request->validated($request->all());
      $user = Ngo::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'location'=>$request->location,
        'beneficiaries'=>$request->beneficiaries,
        'phonenumber'=>$request->phonenumber,
        'licenseNo'=>Hash::make($request->licenseNo),
      ]);
      return $this->success([
        'user'=>$user,
        'type'=>'admin'
,
        'token'=>$user->createToken('Token of'.$user->name)->plainTextToken
      ]);

    }

    /**
     * Logs In An Authenticted Ngo
     */
    public function login(Request $request)
    {
      //working
      $data = $request->validate([
        'name'=>['required','string'],
        'licenseNo'=>['required','integer','min:6']
      ]);
       $name = $request->name;
       $num =$request->licenseNo;

       $ngo = Ngo::where('name',$name)->first();
       $numCheck = Ngo::where('licenseNo',$num)->first();

      if(!$ngo && !$numCheck){
        return response()->json(['message'=>'Credential unmatched']);
      }

       else{
         return response()->json([
          'name'=>$ngo,
          'type'=>'admin'
,
           'token'=>$ngo->createToken('Api Toke of'.$ngo->name)->plainTextToken
         ]);

        };



    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
      //working
        $ngo = Ngo::query()->orderBy('id', 'desc')->paginate(5);
        return response()->json([$ngo,
        'type'=>'user',

      ]);
    }
    public function showNgo($id){
      $ngo = Ngo::findOrFail($id);
          return response()->json([$ngo,
          'type'=>'user',

        ]);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function logout(Ngo $ngo)
    {
        return response()->json('You  Hvae been logged out and Api TOken deleted!');
    }
    public function destroy(Request $request){
      $data = Ngo::FindOrFail($request->id);
      $data->delete();
      return response()->json('',204);
    }
}
