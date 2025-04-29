<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecommendationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $users = User::with('recommendations.major')->get();

        return $users->map(function ($user) {
            return [
                'Nama' => $user->name,
                'Email' => $user->email,
                'Sangat Direkomendasikan' => $user->recommendations->where('level', 'sangat')->first()?->major?->nama_jurusan ?? '-',
                'Cukup Direkomendasikan' => $user->recommendations->where('level', 'cukup')->first()?->major?->nama_jurusan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Sangat Direkomendasikan',
            'Cukup Direkomendasikan',
        ];
    }
}