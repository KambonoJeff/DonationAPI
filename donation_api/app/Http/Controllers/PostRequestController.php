<?php

namespace App\Http\Controllers;

use App\Models\PostRequest;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequestRequest;
use App\Http\Requests\UpdatePostRequestRequest;
use App\Traits\FetchTotals;

class PostRequestController extends Controller
{
  use HttpResponses;
  use FetchTotals;
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
      $data =$this->fetchRequests();
      return $data;
    }
    public function diffrence(){
      $data =$this->fetchRequests();
      $food = $this->fetchFood();
   $cerealDif = $food[0] - $data['Cereals'];
   $proteinDif = $food[1] - $data['Proteins'];
   $legumeDif = $food[2] - $data['Legumes'];
   $snackDif = $food[3] - $data['Snacks'];
   $breakfastDif = $food[4] - $data['Breakfast'];
$data2=[
  $data['Cereals'],
$data['Proteins'],
$data['Legumes'],
$data['Snacks'],
$data['Breakfast']
];
  $data = [
     $cerealDif,
 $proteinDif,
 $legumeDif,
 $snackDif,
 $breakfastDif,

 ];
 $sum = array_sum($data2);

        return response()->json([$data,$sum]);

    }



}
