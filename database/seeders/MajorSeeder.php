<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = [
            ['name' => 'D3 Manajemen Pemasaran'],
            ['name' => 'D3 Manajemen Keuangan Perbankan'],
            ['name' => 'D2 Teknik Otomotif'],
            ['name' => 'D2 Teknik Informatika'],
        ];

        foreach ($majors as $data) {
            Major::create($data);
        }
    }
}