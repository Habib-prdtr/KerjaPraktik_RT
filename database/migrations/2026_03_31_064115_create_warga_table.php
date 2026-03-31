<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();

            // relasi ke kartu keluarga
            $table->unsignedBigInteger('kartu_keluarga_id');

            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('status_perkawinan');

            $table->enum('status', ['aktif', 'pindah', 'meninggal'])->default('aktif');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // foreign key
            $table->foreign('kartu_keluarga_id')
                  ->references('id')
                  ->on('kartu_keluarga')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
