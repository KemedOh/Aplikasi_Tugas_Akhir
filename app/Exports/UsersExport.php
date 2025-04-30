<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $id, $name, $gender, $startDate, $endDate, $startNumber, $endNumber;

    public function __construct($id = null, $name = null, $gender = null, $startDate = null, $endDate = null, $startNumber = null, $endNumber = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->startNumber = $startNumber;
        $this->endNumber = $endNumber;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->id) {
            $query->where('id', $this->id);
        }

        if ($this->name) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }

        if ($this->gender) {
            $query->where('jenis_kelamin', $this->gender);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);
        }

        // Apply filter based on number range
        if ($this->startNumber && $this->endNumber) {
            // Assuming the users are listed in ascending order of their 'id'
            $query->offset($this->startNumber - 1)->limit($this->endNumber - $this->startNumber + 1);
        }

        return $query->select(
            'id', 'name', 'email', 'tanggal_lahir', 'jenis_kelamin',
            'asal_sekolah', 'nama_ayah', 'nama_ibu', 'nomor_telepon',
            'nomor_telepon_ortu', 'created_at'
        )->get()->map(function ($user) {
            return [
                'ID' => $user->id,
                'Nama' => $user->name,
                'Email' => $user->email,
                'Tanggal Lahir' => $user->tanggal_lahir ?? '-',
                'Jenis Kelamin' => $user->jenis_kelamin ?? '-',
                'Asal Sekolah' => $user->asal_sekolah ?? '-',
                'Nama Ayah' => $user->nama_ayah ?? '-',
                'Nama Ibu' => $user->nama_ibu ?? '-',
                'No. Telepon' => $user->nomor_telepon ?? '-',
                'No. Telepon Ortu' => $user->nomor_telepon_ortu ?? '-',
                'Waktu Dibuat' => $user->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 'Nama', 'Email', 'Tanggal Lahir', 'Jenis Kelamin',
            'Asal Sekolah', 'Nama Ayah', 'Nama Ibu', 'Nomor Telepon',
            'Nomor Telepon Ortu', 'Waktu Dibuat'
        ];
    }
}