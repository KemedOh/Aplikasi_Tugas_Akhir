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
                'Email' => $user->nomor_telepon,
                'Sangat Direkomendasikan' => $user->recommendations->where('level', 'sangat_direkomendasikan')->first()?->major?->name ?? '-',
                'Cukup Direkomendasikan' => $user->recommendations->where('level', 'cukup_direkomendasikan')->first()?->major?->name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Nomor HP',
            'Sangat Direkomendasikan',
            'Cukup Direkomendasikan',
        ];
    }
}