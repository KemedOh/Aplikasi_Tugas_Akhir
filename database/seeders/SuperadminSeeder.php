<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role; // pastikan kamu punya model Role
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperadminSeeder extends Seeder
{
    public function run()
    {
        // Cari role superadmin dari tabel roles
        $role = Role::where('role', 'superadmin')->first();

        // Jika role tidak ditemukan, bisa buat terlebih dahulu
        if (!$role) {
            $role = Role::create(['role' => 'superadmin']);
        }

        // Cek jika user superadmin sudah ada
        if (User::where('email', 'superadmin@plb.ac.id')->exists()) {
            return;
        }

        // Buat superadmin baru
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@plb.ac.id',
            'password' => Hash::make('superadminlp3ijuruai'),
            'role_id' => $role->id,
            'remember_token' => Str::random(10),
        ]);
    }
}