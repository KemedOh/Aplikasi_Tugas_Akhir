<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'nomor_telepon',
        'nomor_telepon_ortu',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
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
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function answers()
    {
    return $this->hasMany(UserAnswer::class);
    }
}