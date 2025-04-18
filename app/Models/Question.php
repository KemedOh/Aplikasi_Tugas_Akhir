<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'type', 'category', 'major_id'];

    /**
     * Relasi ke Major: Pertanyaan ini milik satu jurusan.
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * Relasi ke UserAnswer: Pertanyaan ini bisa dijawab oleh banyak user.
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    /**
     * Relasi ke QuestionOption: Pertanyaan memiliki beberapa opsi jawaban.
     */
    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}