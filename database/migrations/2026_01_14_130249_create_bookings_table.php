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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade'); // Paket yang dibooking
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang booking

            $table->date('tour_date'); // Tanggal tour
            $table->integer('guest_count'); // Jumlah guest (harus dicek sesuai guest_min / guest_max paket)
            $table->decimal('total_price', 12, 2);
            $table->string('payment_proof'); // Path bukti pembayaran
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending'); // Status booking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
