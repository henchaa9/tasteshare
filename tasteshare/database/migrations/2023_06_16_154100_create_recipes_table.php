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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->string('title');
            $table->text('desc');
            $table->integer('preptime');
            $table->integer('cooktime');
            $table->integer('servings');
            $table->text('instructions');
            $table->boolean('ispublic');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipeid')->references('id')->on('recipes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    // Add onDelete('cascade') to the foreign key constraint


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
