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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade');

            // Nama paket + deskripsi / overview multi-bahasa
            $table->string('name_id');
            $table->string('name_en');
            $table->text('overview_id')->nullable();
            $table->text('overview_en')->nullable();

            $table->integer('duration');
            $table->integer('guest_min');
            $table->integer('guest_max');
            $table->decimal('price', 12, 2);

            $table->string('image_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
