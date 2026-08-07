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
        Schema::table('keputusan_kariers', function (Blueprint $table) {
            $table->string('test_type')->default('full_test')->after('final_choice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keputusan_kariers', function (Blueprint $table) {
            $table->dropColumn('test_type');
        });
    }
};
