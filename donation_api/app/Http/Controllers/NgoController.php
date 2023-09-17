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
      return response()->json([
'data'=>$user,
'type'=>'ngo',
'token'=>$user->createToken('ngo TOken')->plainTextToken

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
      if($data){
        $name = $request->name;
        $num =$request->licenseNo;
        $ngo = Ngo::where('name',$name)->first();

        if(!$ngo ){
          return response()->json([
            'message'=>'Credential unmatched! name not matched'
          ]);
        }
         if(!Hash::check($num,$ngo->licenseNo)){
           return response()->json([
             'message'=>'Credential unmatched! license number not matched'
           ]);
         }

         else{
           return response()->json([
            strtoupper($ngo->name),
            'type'=>'ngo',
             'token'=>$ngo->createToken('Api Toke of'.$ngo->name)->plainTextToken
           ]);
          }
      }
      else{
        return response()->json([
          'message'=>'Credentials Unmatched! from validation'
        ]);
      }




    }
    public function update(Request $request,$id)
    {
      $data = $request->validate([
        'name'=>['sometime','string','max:255'],
        'email'=>['sometime','string'],
        'location'=>['sometime','string'],
        'beneficiaries'=>['sometime','integer'],
        'phonenumber'=>['sometime','string','max:15'],
        'licenseNo'=>['sometime','integer','min:6']
      ]);
      if(!$data){
        return response()->json([
          'message'=>'An error occured in validation!'
        ],404);
      }else{
        $ngo = Ngo::findOrFail($id)->first();
        if(!$ngo){
          return response()->json([
            'message'=>'Not found'
          ],404);
        }else{
          $ngo->update([
            $ngo->name=$request->name,
            $ngo->email=$request->email,
            $ngo->location=$request->location,
            $ngo->beneficiaries=$request->beneficiaries,
            $ngo->phonenumber=$request->phonenumber,
            $ngo->licenseNo=$request->licenseNo
          ]);
          $ngo->save();
          $ngo->save();
          return response()->json([
            $ngo
          ],200);
        }
      }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
      //working
        $ngo = Ngo::query()->orderBy('id', 'desc')->paginate(3);
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
