<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'image',
        'country_id',
        'video_id',
        'type_id',
        'level_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function correctAnswer():HasOne{
        return $this->hasOne(Answer::class);
    }
}
