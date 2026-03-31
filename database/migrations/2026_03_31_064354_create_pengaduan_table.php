<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();

            // relasi ke warga
            $table->unsignedBigInteger('warga_id');

            $table->string('judul');
            $table->text('isi');
            $table->string('foto')->nullable();

            $table->enum('status', [
                'dikirim',
                'diproses',
                'selesai'
            ])->default('dikirim');

            $table->text('tanggapan_admin')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // foreign key
            $table->foreign('warga_id')
                  ->references('id')
                  ->on('warga')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};