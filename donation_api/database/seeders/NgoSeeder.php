<?php

namespace Database\Seeders;

use App\Models\Ngo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NgoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ngo::Factory()
          ->count(13)

          ->create();
        Ngo::Factory()
          ->count(2)

          ->create();
        Ngo::Factory()
          ->count(4)

          ->create();
    }
}
