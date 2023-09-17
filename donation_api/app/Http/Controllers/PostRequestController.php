<?php

namespace App\Http\Controllers;

use App\Models\PostRequest;
use Illuminate\Http\Request;
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
      $legumes = DB::table('post_requests')
          ->select('quantity')
          ->where('typeoffood','=','legumes')
          ->get()
          ->all();
      $snacks = DB::table('post_requests')
          ->select('quantity')
          ->where('typeoffood','=','snacks')
          ->get()
          ->all();
      $breakfast=DB::table('post_Requests')
          ->select('quantity')
          ->where('typeoffood','=','breakfast')
          ->get()
          ->all();
      $func = function($x){
        return $x->quantity;
      };
      // getting the values
      $mappedcereals=array_map($func,$cereals);
      $mappedproteins=array_map($func,$proteins);
      $mappedlegumes=array_map($func,$legumes);
      $mappedsnacks=array_map($func,$snacks);
      $mappedbreakfast=array_map($func,$breakfast);
      // adding the array

    $totalcereals = array_sum($mappedcereals);
      $totalproteins = array_sum($mappedproteins);
      $totallegumes = array_sum($mappedlegumes);
      $totalsnacks = array_sum($mappedsnacks);
      $totalbreakfast = array_sum($mappedbreakfast);

      return response()->json([
        'Cereals'=>$totalcereals,
       'Proteins'=>$totalproteins,
       'Legumes'=>$totallegumes,
       'Snacks'=>$totalsnacks,
       'Breakfast'=>$totalbreakfast
      ],200);
    }
    public function diffrence(Request $request){
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
  $legumes = DB::table('post_requests')
      ->select('quantity')
      ->where('typeoffood','=','legumes')
      ->get()
      ->all();
  $snacks = DB::table('post_requests')
      ->select('quantity')
      ->where('typeoffood','=','snacks')
      ->get()
      ->all();
  $breakfast=DB::table('post_Requests')
      ->select('quantity')
      ->where('typeoffood','=','breakfast')
      ->get()
      ->all();
  $func = function($x){
    return $x->quantity;
  };
  // getting the values
  $mappedcereals=array_map($func,$cereals);
  $mappedproteins=array_map($func,$proteins);
  $mappedlegumes=array_map($func,$legumes);
  $mappedsnacks=array_map($func,$snacks);
  $mappedbreakfast=array_map($func,$breakfast);
  // adding the array

$totalcereals = array_sum($mappedcereals);
  $totalproteins = array_sum($mappedproteins);
  $totallegumes = array_sum($mappedlegumes);
  $totalsnacks = array_sum($mappedsnacks);
  $totalbreakfast = array_sum($mappedbreakfast);

  $cerealDif = $request->cereals - $totalcereals;
  $proteinDif = $request->proteins - $totalproteins;
  $legumeDif = $request->legumes - $totallegumes;
  $snackDif = $request->snacks - $totalsnacks;
  $breakfastDif = $request->breakfast - $totalbreakfast;
$data2=[
  $totalcereals,
$totalproteins,
$totallegumes,
$totalsnacks,
$totalbreakfast,
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
