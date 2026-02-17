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
        Schema::create('contacts_info', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // phone, email, address, map_embed
            $table->string('label')->nullable();
            $table->text('value_id'); // Untuk bahasa default / Indonesia
            $table->text('value_en')->nullable(); // Untuk bahasa Inggris, optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts_info');
    }
};
