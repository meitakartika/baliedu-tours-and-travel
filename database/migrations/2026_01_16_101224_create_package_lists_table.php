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
        Schema::create('package_lists', function (Blueprint $table) {
            $table->id();
            // Relasi ke package / tour
            $table->foreignId('package_id')
                  ->constrained('packages')
                  ->onDelete('cascade');

            // Jenis list
            $table->enum('type', [
                'must_bring',
                'includes',
                'not_includes'
            ]);

            // Isi bullet
            $table->string('content_id');
            $table->string('content_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_lists');
    }
};
