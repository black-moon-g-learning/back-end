<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlayGame extends Model
{
    use HasFactory;

    protected $table= 'users_play_games';
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'percent'
    ];
}
