<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'type', 'category', 'major_id'];

    // Relasi ke tabel Major (Pertanyaan mungkin berkaitan dengan satu Jurusan)
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    // Relasi ke tabel UserAnswers (Satu Pertanyaan bisa dijawab banyak User)
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}