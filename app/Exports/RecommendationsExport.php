<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecommendationsExport implements FromCollection, WithHeadings
{
    protected $majorId;
    protected $startNumber;
    protected $endNumber;
    protected $name;


    public function __construct($majorId = null, $startNumber = null, $endNumber = null, $name = null)
    {
        $this->majorId = $majorId;
        $this->startNumber = $startNumber;
        $this->endNumber = $endNumber;
        $this->name = $name;
    }

public function collection()
{
    // Ambil user yang punya setidaknya satu rekomendasi jurusan
    $users = User::with('recommendations.major')
        ->get()
        ->filter(function ($user) {
            return $user->recommendations->whereIn('level', ['sangat_direkomendasikan', 'cukup_direkomendasikan'])->isNotEmpty();
        });

    // Filter berdasarkan major_id jika ada
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