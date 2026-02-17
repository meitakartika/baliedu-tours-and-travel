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
        Schema::create('package_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade'); // Paket yang direview
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang review
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete(); // Id booking

            $table->tinyInteger('rating'); // 1-5
            $table->text('comment')->nullable(); // Testimonial / review
            $table->json('images')->nullable();
            $table->boolean('agreement')->default(false); // Checkbox setuju, harus dicentang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_reviews');
    }
};
