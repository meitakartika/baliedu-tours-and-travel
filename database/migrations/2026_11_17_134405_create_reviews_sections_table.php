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
        Schema::create('reviews_sections', function (Blueprint $table) {
            $table->id();

            // LEFT CONTENT
            $table->string('label_id')->nullable();
            $table->string('label_en')->nullable();

            $table->string('title_1_id')->nullable();
            $table->string('title_1_en')->nullable();

            $table->decimal('rating_number', 3, 1)->default(5.0);
            $table->string('reviews_text_id')->nullable();
            $table->string('reviews_text_en')->nullable();

            $table->unsignedInteger('travelers_number')->default(0);
            $table->string('travelers_text_id')->nullable();
            $table->string('travelers_text_en')->nullable();

            // TESTIMONIAL CARD 1
            $table->string('card_title_1_id')->nullable();
            $table->string('card_title_1_en')->nullable();
            $table->text('card_description_1_id')->nullable();
            $table->text('card_description_1_en')->nullable();
            $table->string('reviewer_name_1')->nullable();
            $table->string('reviewer_country_1_id')->nullable();
            $table->string('reviewer_country_1_en')->nullable();
            $table->string('reviewer_image_1')->nullable();

            // TESTIMONIAL CARD 2
            $table->string('card_title_2_id')->nullable();
            $table->string('card_title_2_en')->nullable();
            $table->text('card_description_2_id')->nullable();
            $table->text('card_description_2_en')->nullable();
            $table->string('reviewer_name_2')->nullable();
            $table->string('reviewer_country_2_id')->nullable();
            $table->string('reviewer_country_2_en')->nullable();
            $table->string('reviewer_image_2')->nullable();

            // TESTIMONIAL CARD 3
            $table->string('card_title_3_id')->nullable();
            $table->string('card_title_3_en')->nullable();
            $table->text('card_description_3_id')->nullable();
            $table->text('card_description_3_en')->nullable();
            $table->string('reviewer_name_3')->nullable();
            $table->string('reviewer_country_3_id')->nullable();
            $table->string('reviewer_country_3_en')->nullable();
            $table->string('reviewer_image_3')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews_sections');
    }
};
