<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watched extends Model
{
    use HasFactory;

    protected $table = 'watched';

    protected $fillable = [
        'user_id',
        'video_id',
        'stop_at'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
