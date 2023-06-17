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
        Schema::create('recipe_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipeid');
            $table->foreign('recipeid')->references('id')->on('recipes')->onDelete('cascade');
            $table->longText('imageurl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_images');
    }
};
