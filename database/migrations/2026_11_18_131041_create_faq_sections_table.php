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
        Schema::create('faq_sections', function (Blueprint $table) {
            $table->id();

            // HEADING
            $table->string('label_id')->nullable();
            $table->string('label_en')->nullable();

            $table->string('title_id')->nullable();
            $table->string('title_en')->nullable();

            // FAQ ITEMS 1-6
            for ($i = 1; $i <= 6; $i++) {
                $table->string("question_{$i}_id")->nullable();
                $table->string("question_{$i}_en")->nullable();

                $table->text("answer_{$i}_id")->nullable();
                $table->text("answer_{$i}_en")->nullable();
            }
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_sections');
    }
};
