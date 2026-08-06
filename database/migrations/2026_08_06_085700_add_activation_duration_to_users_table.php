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
            $table->timestamp('activated_at')->nullable()->after('status');
            $table->unsignedTinyInteger('activation_duration_months')->nullable()->after('activated_at');
            $table->timestamp('expires_at')->nullable()->after('activation_duration_months');
        });

        // Backfill: set activated_at for existing active users
        \Illuminate\Support\Facades\DB::table('users')
            ->where('status', 'active')
            ->whereNull('activated_at')
            ->update(['activated_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['activated_at', 'activation_duration_months', 'expires_at']);
        });
    }
};
