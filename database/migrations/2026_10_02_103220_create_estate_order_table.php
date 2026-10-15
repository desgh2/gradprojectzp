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
        Schema::create('estate_order', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 300)->nullable();
            $table->string('name', 300)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('comment', 600)->nullable();
            $table->string('status', 28)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_order');
    }
};
