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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('byfather');
            $table->string('post');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('office_number')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('persons');
    }
};
