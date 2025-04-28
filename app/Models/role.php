<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static function rules($role)
{
    $rules = [
        'nama' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ];

    if ($role === 'mahasiswa') {
        $rules['tanggal_lahir'] = 'required|date';
        $rules['jenis_kelamin'] = 'required|in:L,P';
        $rules['asal_sekolah'] = 'required|string|max:150';
    }

    return $rules;
}
}