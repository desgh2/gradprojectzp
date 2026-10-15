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
        Schema::table('advert', function (Blueprint $table) {
            $table->string('order', 600)->after('pasport')->nullable();
            $table->text('additional')->after('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advert', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->dropColumn('additional');
        });
    }
};
