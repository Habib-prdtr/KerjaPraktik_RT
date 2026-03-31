<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->unique();

            // opsi 1: simpan nama langsung
            $table->string('kepala_keluarga');

            // opsi 2 (lebih bagus): relasi ke tabel warga
            // $table->unsignedBigInteger('kepala_keluarga_id')->nullable();

            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->timestamp('created_at')->useCurrent();

            // kalau mau update juga:
            $table->timestamp('updated_at')->nullable();

            // kalau pakai relasi:
            // $table->foreign('kepala_keluarga_id')
            //       ->references('id')->on('warga')
            //       ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_keluarga');
    }
};
