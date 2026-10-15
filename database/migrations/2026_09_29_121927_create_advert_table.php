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
        Schema::create('advert', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300)->nullable();
            $table->string('description', 300)->nullable();
            $table->string('heading', 300)->nullable();
            $table->string('slug', 300)->nullable();
            $table->string('name', 300)->nullable();
            $table->integer('district_id')->nullable();
            $table->bigInteger('place_id')->nullable();
            $table->string('lat', 24)->nullable();
            $table->string('lon', 24)->nullable();
            $table->string('poster', 300)->nullable();
            $table->text('gallery')->nullable();
            $table->string('pasport', 600)->nullable();
            $table->text('text')->nullable();
            $table->string('status', 28)->nullable();
            $table->integer('author')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert');
    }
};
