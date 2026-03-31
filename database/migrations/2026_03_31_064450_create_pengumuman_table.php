<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal');

            // relasi ke users (admin pembuat)
            $table->unsignedBigInteger('created_by');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // foreign key
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
