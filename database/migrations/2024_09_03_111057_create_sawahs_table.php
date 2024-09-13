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
        Schema::create('sawahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sawah');
            $table->string('lokasi_sawah')->nullable();
            $table->double('luas_sawah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sawahs');
    }
};
