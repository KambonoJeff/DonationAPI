<?php

namespace Database\Seeders;

use App\Models\PostRequest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostRequest::Factory()
          ->count(99)
          ->create();
    }
}
