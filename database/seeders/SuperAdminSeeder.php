<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Institution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada instansi "Global" untuk SuperAdmin
        $institution = Institution::firstOrCreate(['name' => 'Sistem Global Rencana Karierku']);

        User::firstOrCreate(
            ['email' => 'superadmin@rencanakarierku.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('SuperAdmin123!'),
                'role' => 'superadmin',
                'institution_id' => $institution->id,
                'phone' => '080000000000',
                'status' => 'active',
            ]
        );
    }
}
