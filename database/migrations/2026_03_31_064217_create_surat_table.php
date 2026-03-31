<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();

            // relasi ke warga
            $table->unsignedBigInteger('warga_id');

            $table->string('jenis_surat');
            $table->string('nomor_surat')->unique();
            $table->text('keperluan');

            $table->enum('status', [
                'diajukan',
                'diproses',
                'selesai',
                'ditolak'
            ])->default('diajukan');

            $table->string('file_pdf')->nullable();

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
        Schema::dropIfExists('surat');
    }
};
