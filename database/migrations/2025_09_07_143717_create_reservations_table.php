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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // n° reservation
            $table->foreignId('train_id')->constrained('trains')->onDelete('cascade');
            $table->foreignId('itineraire_id')->constrained('itineraires')->onDelete('cascade');
            $table->date('date_reservation');
            $table->string('nomvoyageur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
