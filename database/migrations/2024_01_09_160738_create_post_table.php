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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300)->nullable();
            $table->string('description', 300)->nullable();
            $table->string('name', 300)->nullable();
            $table->string('heading', 300)->nullable();
            $table->string('slug', 300)->nullable();
            $table->text('text')->nullable();
            $table->string('poster', 300)->nullable();
            $table->text('gallery')->nullable();
            $table->string('status')->default('active')->nullable();
            $table->integer('author')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
