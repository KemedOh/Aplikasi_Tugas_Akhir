<?php

namespace App\Exports;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        $pdf = Pdf::loadView('users.pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
public function downloadFiltered(Request $request)
{
    $query = User::query();

    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('jenis_kelamin')) {
        $query->where('jenis_kelamin', $request->jenis_kelamin);
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    // Ambil semua data hasil filter
    $users = $query->select(
        'id',
        'name',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'nomor_telepon',
        'nomor_telepon_ortu'
    )->orderBy('id')->get();

    // Filter berdasarkan nomor urut (index dari 1, bukan dari ID)
    if ($request->filled('start_number') && $request->filled('end_number')) {
        $start = (int)$request->start_number - 1; // karena index dimulai dari 0
        $length = (int)$request->end_number - $start;
        $users = $users->slice($start, $length)->values();
    }

    $pdf = Pdf::loadView('users.pdf', compact('users'))
              ->setPaper('a4', 'landscape');

    return $pdf->download('users_filtered.pdf');
}


}