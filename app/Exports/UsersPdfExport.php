<?php

namespace App\Exports;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UsersPdfExport
{
    public function download()
    {
        $users = User::select(
            'name',
            'email',
            'tanggal_lahir',
            'jenis_kelamin',
            'asal_sekolah',
            'nama_ayah',
            'nama_ibu',
            'nomor_telepon',
            'nomor_telepon_ortu'
        )->get()->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'tanggal_lahir' => $user->tanggal_lahir ?? '-',
                'jenis_kelamin' => $user->jenis_kelamin ?? '-',
                'asal_sekolah' => $user->asal_sekolah ?? '-',
                'nama_ayah' => $user->nama_ayah ?? '-',
                'nama_ibu' => $user->nama_ibu ?? '-',
                'nomor_telepon' => $user->nomor_telepon ?? '-',
                'nomor_telepon_ortu' => $user->nomor_telepon_ortu ?? '-',
            ];
        });

        $pdf = Pdf::loadView('exports.users_pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
}