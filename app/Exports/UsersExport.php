<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with('role')->select(
            'name',
            'email',
            'tanggal_lahir',
            'jenis_kelamin',
            'asal_sekolah',
            'nama_ayah',
            'nama_ibu',
            'nomor_telepon',
            'nomor_telepon_ortu',
            'role_id'
        )->get()->map(function ($user) {
            return [
                'Nama' => $user->name,
                'Email' => $user->email,
                'Tanggal Lahir' => $user->tanggal_lahir ?? '-',
                'Jenis Kelamin' => $user->jenis_kelamin ?? '-',
                'Asal Sekolah' => $user->asal_sekolah ?? '-',
                'Nama Ayah' => $user->nama_ayah ?? '-',
                'Nama Ibu' => $user->nama_ibu ?? '-',
                'No. Telepon' => $user->nomor_telepon ?? '-',
                'No. Telepon Orang Tua' => $user->nomor_telepon_ortu ?? '-',
                'Role' => $user->role->role_name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama', 'Email', 'Tanggal Lahir', 'Jenis Kelamin',
            'Asal Sekolah', 'Nama Ayah', 'Nama Ibu', 'Nomor Telepon',
            'Nomor Telepon Orang Tua'
        ];
    }
}