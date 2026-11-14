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
        Schema::create('statistics_sections', function (Blueprint $table) {
            $table->id();

            // Heading - Indonesian
            $table->string('label_id');
            $table->string('title_id');
            $table->text('description_id');

            // Heading - English
            $table->string('label_en');
            $table->string('title_en');
            $table->text('description_en');

            // Statistics 1
            $table->string('number_1');
            $table->string('text_1_id');
            $table->string('text_1_en');

            // Statistics 2
            $table->string('number_2');
            $table->string('text_2_id');
            $table->string('text_2_en');

            // Statistics 3
            $table->string('number_3');
            $table->string('text_3_id');
            $table->string('text_3_en');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics_sections');
    }
};
