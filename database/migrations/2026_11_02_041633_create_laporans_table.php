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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            // restrictOnDelete mencegah akun pelapor terhapus jika masih memiliki data laporan
            $table->foreignId('pelapor_id')->constrained('users')->restrictOnDelete();
            $table->string('judul');
            $table->text('detail');
            $table->date('tanggal');
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending')->index();
            $table->timestamps();

            // Index gabungan untuk mempercepat query riwayat pelapor berdasarkan urutan waktu
            $table->index(['pelapor_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
