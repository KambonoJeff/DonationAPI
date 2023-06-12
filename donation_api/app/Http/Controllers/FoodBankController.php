<?php

namespace App\Http\Controllers;

use App\Models\FoodBank;
use App\Http\Requests\StoreFoodBankRequest;
use App\Http\Requests\UpdateFoodBankRequest;
use App\Traits\HttpResponses;

class FoodBankController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food = FoodBank::query()->orderBy('id', 'desc')->paginate();
        $sumcash = FoodBank::pluck('cash')->toArray();
        $sumcereals = FoodBank::pluck('cereals')->toArray();
        $sumproteins = FoodBank::pluck('proteins')->toArray();
        $sumlegume = FoodBank::pluck('legumes')->toArray();
        $sumsnacks = FoodBank::pluck('snacks')->toArray();
        $sumBreak = FoodBank::pluck('breakfast')->toArray();

          $totalCash = array_sum($sumcash);
          $totalBreak = array_sum($sumBreak);
          $totalSnacks = array_sum($sumsnacks);
          $totaproteins = array_sum($sumproteins);
          $totalcereals = array_sum($sumcereals);
          $totallegume = array_sum($sumlegume);
          $data = [$totalcereals,$totaproteins,$totallegume,$totalBreak,$totalSnacks,$totalCash,$food];

        $data = $food;

        return response()->json($data);
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
        return response()->json($food);
          }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = FoodBank::findOrFail($id);
        return $this->success([
          'data'=>$data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodBankRequest $request,$id )
    {
        $request->validated($request->all());
        $food= FoodBank::findOrFail($id);
        $food->update([
          $food->cereals = $request->cereals,
          $food->proteins = $request->proteins,
          $food->legumes = $request->legumes,
          $food->breakfast = $request->breakfast,
          $food->snacks = $request->snacks,
          $food->cash = $request->cash,
        ]);
        $food->save();
        return $this->success([
          'data'=>$food
        ]);
    }

}
