<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'level_id',
        'country_id',
        'total_correct_answers',
        'total_questions'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
