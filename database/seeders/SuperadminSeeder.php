<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cek jika superadmin sudah ada
        if (role::where('role', 'superadmin')->exists()) {
            return; // Superadmin sudah ada, tidak perlu menambah lagi
        }

        // Menambahkan superadmin baru
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@plb.ac.id',
            'password' => Hash::make('superadminlp3ijuruai'),
            'role' => 'superadmin',
            'remember_token' => Str::random(10),
        ]);
    }
}