<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'question_id', 
        'value', 
        'option_id', 
        'major_id',
    ];

    // Relasi ke tabel User (Satu Jawaban dimiliki oleh satu User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Question (Satu Jawaban terkait dengan satu Pertanyaan)
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relasi ke tabel QuestionOption (Satu Jawaban terkait dengan satu Pilihan)
    public function option()
    {
        return $this->belongsTo(QuestionOption::class);
    }

    // Relasi ke tabel Major (Satu Jawaban terkait dengan satu Major)
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}