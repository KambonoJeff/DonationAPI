<?php

namespace Database\Seeders;

use App\Models\FoodBank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodBank::factory()->count(40)->create();
    }
}
