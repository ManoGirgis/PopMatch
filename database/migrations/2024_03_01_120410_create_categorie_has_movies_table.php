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
        Schema::create('categorie_has_movies', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('movie_id');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->primary(['categorie_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_has_movies');
    }
};
