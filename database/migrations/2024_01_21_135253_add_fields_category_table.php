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
        Schema::table('category', function (Blueprint $table) {
            $table->boolean('primary_menu')->nullable(); //показати в головному меню
            $table->boolean('footer_menu')->nullable(); //показати в футері меню
            $table->integer('in_order')->nullable(); //номер за порядком
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('primary_menu');
            $table->dropColumn('footer_menu');
            $table->dropColumn('in_order');
        });
    }
};
