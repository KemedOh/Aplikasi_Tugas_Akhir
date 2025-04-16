<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    public function run()
    {
        Major::insert([
            ['id' => 1, 'name' => 'Teknik Informatika (D2)'],
            ['id' => 2, 'name' => 'Teknik Otomotif (D2)'],
            ['id' => 3, 'name' => 'Manajemen Pemasaran (D3)'],
            ['id' => 4, 'name' => 'Manajemen Keuangan Perbankan (D3)'],
        ]);
    }
}