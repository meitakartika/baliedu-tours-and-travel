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
        Schema::create('discover_sections', function (Blueprint $table) {
            $table->id();

            // Heading - Indonesian
            $table->string('label_id');
            $table->string('title_id');
            $table->text('description_id');
            $table->string('button_id');

            // Heading - English
            $table->string('label_en');
            $table->string('title_en');
            $table->text('description_en');
            $table->string('button_en');

            // Images
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discover_sections');
    }
};
