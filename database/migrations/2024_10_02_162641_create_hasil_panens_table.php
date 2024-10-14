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
        Schema::create('hasil_panens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petani_id')->constrained('petanis')->onDelete('cascade');
            $table->foreignId('lahan_id')->constrained('lahans')->onDelete('cascade');
            $table->foreignId('bibit_id')->constrained('bibits')->onDelete('cascade');
            $table->foreignId('tanaman_id')->constrained('tanamen')->onDelete('cascade');
            $table->foreignId('pupuk_id')->constrained('pupuks')->onDelete('cascade');
            $table->date('tanggal_panen')->nullable();
            $table->integer('jumlah_hasil_panen');
            $table->enum('status_penjualan', ['Terjual', 'Tersedia']);
            $table->string('nama_pembeli')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_panens');
    }
};
