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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending')->after('is_active');
        });

        // Migrate existing data
        \Illuminate\Support\Facades\DB::table('users')->update([
            'status' => \Illuminate\Support\Facades\DB::raw("IF(is_active = 1, 'active', 'pending')")
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('status');
        });

        \Illuminate\Support\Facades\DB::table('users')->update([
            'is_active' => \Illuminate\Support\Facades\DB::raw("IF(status = 'active', 1, 0)")
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
