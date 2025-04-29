<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecommendationsExport implements FromCollection, WithHeadings
{
    protected $majorId;

    public function __construct($majorId = null)
    {
        $this->majorId = $majorId;
    }

    public function collection()
    {
        // Ambil semua user dengan relasi recommendations dan major
        $users = User::with('recommendations.major')->get();

        // Jika ada filter jurusan
        if ($this->majorId) {
            $users = $users->filter(function ($user) {
                return $user->recommendations->contains(function ($recommendation) {
                    return $recommendation->major_id == $this->majorId;
                });
            });
        }

        return $users->map(function ($user) {
            return [
                'Nama' => $user->name,
                'Email' => $user->email,
                'Nomor Telepon' => $user->nomor_telepon ?? '-',
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