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
        Schema::create('contact_heroes', function (Blueprint $table) {
            $table->id();

            $table->string('image')->nullable();
            $table->string('title_id_1')->nullable();
            $table->string('title_id_2')->nullable();
            $table->string('title_en_1')->nullable();
            $table->string('title_en_2')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_heroes');
    }
};
