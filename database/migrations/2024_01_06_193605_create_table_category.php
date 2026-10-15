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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('name')->nullable();
            $table->string('heading')->nullable();
            $table->string('slug')->nullable();
            $table->text('text')->nullable();
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
        Schema::dropIfExists('category');
    }
};
