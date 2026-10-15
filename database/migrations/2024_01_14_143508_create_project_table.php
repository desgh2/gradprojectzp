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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_id')->nullable();
            $table->string('title', 300)->nullable();
            $table->string('description', 300)->nullable();
            $table->string('name', 300)->nullable();
            $table->string('heading', 300)->nullable();
            $table->string('slug', 300)->nullable();
            $table->string('short_text', 300)->nullable();
            $table->text('text')->nullable();
            $table->string('address', 300)->nullable(); //адреса об`єкта
            $table->string('type', 300)->nullable(); //тип об`єкта
            $table->string('do_work', 300)->nullable(); //вид роботи на об`єкті (реконструкція, проектування)
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
        Schema::dropIfExists('project');
    }
};
