<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'major_id','score', 'level'];

   public function major()
{
    return $this->belongsTo(Major::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}