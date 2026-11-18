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
        Schema::create('gallery_sections', function (Blueprint $table) {
            $table->id();

            $table->string('label_id')->nullable();
            $table->string('label_en')->nullable();

            $table->string('title_id')->nullable();
            $table->string('title_en')->nullable();

            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();

            $table->string('button_id')->nullable();
            $table->string('button_en')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_sections');
    }
};
