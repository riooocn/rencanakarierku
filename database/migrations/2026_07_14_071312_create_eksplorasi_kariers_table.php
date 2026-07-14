<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eksplorasi_kariers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('option'); // 1 or 2
            $table->string('career_name');
            $table->text('pendidikan')->nullable();
            $table->text('jurusan')->nullable();
            $table->text('matkul')->nullable();
            $table->text('keterampilan')->nullable();
            $table->text('pelatihan')->nullable();
            $table->text('sertifikasi')->nullable();
            $table->text('peluang')->nullable();
            $table->text('tugas')->nullable();
            $table->text('info_lain')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eksplorasi_kariers');
    }
};
