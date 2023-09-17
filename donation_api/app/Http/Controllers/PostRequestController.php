<?php

namespace App\Http\Controllers;

use App\Models\PostRequest;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequestRequest;
use App\Http\Requests\UpdatePostRequestRequest;

class PostRequestController extends Controller
{
  use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //WORKING
        $postedrequests = PostRequest::query()->orderBy('id' , 'desc')->paginate(6);
        return response()->json($postedrequests);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function debugtest(StorePostRequestRequest $request)
    {
      //to be reviewed
         $request->validated($request->all());
         $postedrequest = PostRequest::create([
           'user_id'=>$request->user_id,
           'typeoffood'=>$request->typeoffood,
           'quantity'=>$request->quantity,
           'beneficiaries'=>$request->beneficiaries,
           'location'=>$request->location,
           'status'=>$request->status,
         ]);
        return response()->json($postedrequest);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PostRequest::findOrFail($id);
        return response()->json($data);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequestRequest $request, $id)
    {

       $request->validated($request->all());
       $post = PostRequest::findOrFail($id);
       $post->update([
         $post->user_id= $request->user_id,
         $post->typeoffood= $request->typeoffood,
         $post->quantity= $request->quantity,
         $post->beneficiaries= $request->beneficiaries,
         $post->location= $request->location,
         $post->status= $request->status,
       ]);
       $post->save();
      return response()->json($post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PostRequest::findOrFail($id);
        $data->delete();
        return response('deleted',204);
    }
    public function compare()
    {
      $cereals = DB::table('post_requests')
          ->select('quantity')
          ->where('typeoffood' ,'=','cereals')
          ->get()
          ->all();
      $proteins = DB::table('post_requests')
          ->select('quantity')
          ->where('typeoffood', '=' , 'proteins')
          ->get()
          ->all();
      $legume = DB::table('post_requests')
          ->select('quantity')
          ->where('typeoffood','=','legumes')
          ->get()
          ->all();
      $snacks = DB::table('post_requests')
          ->select('quantity')
          ->where('typeoffood','=','snacks')
          ->get()
          ->all();
      $breakfast=DB::table('post_Request')
          ->select('quantity')
          ->where('typeoffood','=','breakfast')
          ->get()
          ->all();


      if(!$cereals){
        return response()->json([
          'message'=>'Error when Querying base'
        ],404);
      }

      return response()->json([
        'message'=>'Responded with a 200',
         $cereals
      ],200);
    }



}
