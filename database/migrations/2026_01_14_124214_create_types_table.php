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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relasi kategori
            $table->string('name_id'); // Nama tipe Bahasa Indonesia
            $table->string('name_en'); // Nama tipe Bahasa Inggris
            $table->text('description_id')->nullable(); // Deskripsi Bahasa Indonesia
            $table->text('description_en')->nullable(); // Deskripsi Bahasa Inggris
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
