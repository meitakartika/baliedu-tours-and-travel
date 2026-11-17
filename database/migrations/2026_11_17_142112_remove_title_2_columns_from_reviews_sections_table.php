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
        Schema::table('reviews_sections', function (Blueprint $table) {
            $table->dropColumn([
                'title_2_id',
                'title_2_en',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews_sections', function (Blueprint $table) {
            $table->string('title_2_id')->nullable();
            $table->string('title_2_en')->nullable();
        });
    }
};
