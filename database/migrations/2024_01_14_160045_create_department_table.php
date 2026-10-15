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
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('person_id')->nullable();
            $table->string('name', 300)->nullable();
            $table->string('description', 300)->nullable();
            $table->string('heading', 300)->nullable();
            $table->string('slug', 300)->nullable();
            $table->string('cabinet', 8)->nullable();
            $table->string('phone', 28)->nullable();
            $table->string('telephone', 28)->nullable();
            $table->string('email', 64)->nullable();
            $table->text('text')->nullable();
            $table->string('icon', 300)->nullable();
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
        Schema::dropIfExists('department');
    }
};
