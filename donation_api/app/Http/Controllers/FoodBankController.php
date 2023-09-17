<?php

namespace App\Http\Controllers;

use App\Models\FoodBank;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreFoodBankRequest;
use App\Http\Requests\UpdateFoodBankRequest;

class FoodBankController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food = FoodBank::query()->orderBy('id', 'desc')->paginate(7);
        $sumcash = FoodBank::pluck('cash')->toArray();
        $sumcereals = FoodBank::pluck('cereals')->toArray();
        $sumproteins = FoodBank::pluck('proteins')->toArray();
        $sumlegume = FoodBank::pluck('legumes')->toArray();
        $sumsnacks = FoodBank::pluck('snacks')->toArray();
        $sumBreak = FoodBank::pluck('breakfast')->toArray();

          $totalCash =number_format(array_sum($sumcash));
          $totalBreak =number_format( array_sum($sumBreak));
          $totalSnacks = number_format(array_sum($sumsnacks));
          $totaproteins = number_format(array_sum($sumproteins));
          $totalcereals = number_format(array_sum($sumcereals));
          $totallegume = number_format(array_sum($sumlegume));
          $data = [$totalcereals,$totaproteins,$totallegume,$totalBreak,$totalSnacks,$totalCash,$food];


        return response()->json($data);
    }
    public function sumall()
    {
      $sumcereals = FoodBank::pluck('cereals')->toArray();
      $sumproteins = FoodBank::pluck('proteins')->toArray();
      $sumlegume = FoodBank::pluck('legumes')->toArray();
      $sumsnacks = FoodBank::pluck('snacks')->toArray();
      $sumBreak = FoodBank::pluck('breakfast')->toArray();
      $sumcash = FoodBank::pluck('cash')->toArray();
      $totalcash=array_sum($sumcash);
      $totalBreak = array_sum($sumBreak);
      $totalSnacks = array_sum($sumsnacks);
      $totaproteins = array_sum($sumproteins);
      $totalcereals = array_sum($sumcereals);
      $totallegume = array_sum($sumlegume);
      $data = [$totalcereals,$totaproteins,$totallegume,$totalBreak,$totalSnacks];
      $func = function($carry,$item){
        return $carry + $item;
      };
      $sumed = array_reduce($data,$func);

      ;
      return response()->json([
        number_format($sumed),
        number_format($totalcash)
      ],200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodBankRequest $request)
    {
        $request->validated($request->all());
        $food = FoodBank::create([
          'cereals'=>$request->cereals,
          'proteins'=>$request->proteins,
          'legumes'=>$request->legumes,
          'breakfast'=>$request->breakfast,
          'snacks'=>$request->snacks,
          'cash'=>$request->cash,
        ]);

        return response()->json([
          'data'=>$food,



      ]);
          }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = FoodBank::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodBankRequest $request,$id )
    {
        $request->validated($request->all());
        $food= FoodBank::findOrFail($id)->first();
        if(!$food){
          return response()->json([
            'message'=>'Not found'
          ],404);
        }else{
          $food->update([
            $food->cereals = $request->cereals,
            $food->proteins = $request->proteins,
            $food->legumes = $request->legumes,
            $food->breakfast = $request->breakfast,
            $food->snacks = $request->snacks,
            $food->cash = $request->cash,
          ]);
          $food->save();
          $food->save();
          $food->save();
          return response()->json([
            'message'=>'sucsefully updated',
            $food

          ]);


        }
    }
    public function destroy($id){
      $data = FoodBank::findOrFail($id)->first();
      if(!$data){
        return response()->json(['message'=>'Not Found'],404);
      }else{
        $data->delete();
        return response()->json([''],204);
      }

    }

}
