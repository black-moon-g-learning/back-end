<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'country_topic_id',
        'url',
        'owner_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
