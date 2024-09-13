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
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tanam')->nullable();
            $table->foreignId('tanaman_id')->constrained('tanamen')->onDelete('cascade');
            $table->foreignId('varietas_id')->constrained('varietas')->onDelete('cascade');
            $table->foreignId('pupuk_id')->constrained('petanis')->onDelete('cascade');
            $table->foreignId('petani_id')->constrained('petanis')->onDelete('cascade');
            $table->foreignId('sawah_id')->constrained('sawahs')->onDelete('cascade');
            $table->date('tanggal_panen')->nullable();
            $table->string('status_panen')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
