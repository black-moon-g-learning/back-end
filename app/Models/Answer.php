<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'image',
        'question_id',
        'is_correct'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'image'
    ];
}
