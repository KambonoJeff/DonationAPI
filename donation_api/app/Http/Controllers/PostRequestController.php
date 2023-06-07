<?php

namespace App\Http\Controllers;

use App\Models\PostRequest;
use App\Http\Requests\StorePostRequestRequest;
use App\Http\Requests\UpdatePostRequestRequest;
use App\Traits\HttpResponses;

class PostRequestController extends Controller
{
  use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //WORKING
        $postedrequests = PostRequest::get()->all();
        return response()->json($postedrequests);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequestRequest $request)
    {
        // $request->validated($request->all());
        // $postedrequest = PostRequest::create([
        //   'user_id'=>$request->user_id,
        //   'typeoffood'=>$request->typeoffood,
        //   'quantity'=>$request->quantity,
        //   'beneficiaries'=>$request->beneficiaries,
        //   'location'=>$request->location,
        //   'status'=>$request->status,
        // ]);
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PostRequest::findOrFail($id);
        return $this->success([
          'data'=>$data
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequestRequest $request, $id)
    {
      // $request->validated($request->all());
      // $post = PostRequest::findOrFail($id);
      // $post->update([
      //   $post->user_id= $request->user_id,
      //   $post->typeoffood= $request->typeoffood,
      //   $post->quantity= $request->quantity,
      //   $post->beneficiaries= $request->beneficiaries,
      //   $post->location= $request->location,
      //   $post->status= $request->status,
      // ]);
      // $post->save();
      return $request;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PostRequest::findOrFail($id);
        $data->delete();
        return response([],204);
    }
}
