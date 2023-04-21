<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_requests', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->string('typeoffood');
          $table->integer('quantity');
          $table->integer('beneficiaries');
          $table->string('location');
          $table->string('status');

          $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_requests');
    }
};
