<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesmen_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('assessment_sessions')->cascadeOnDelete();
            $table->json('recap_scores')->nullable();
            $table->json('top_results')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesmen_results');
    }
};
