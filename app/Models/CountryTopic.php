<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryTopic extends Model
{
    use HasFactory;

    protected $table = 'countries_topics';

    /**
     * @var string[]
     */
    protected $fillable = [
        'country_id',
        'topic_id',
    ];

    public function topic()
    {
        return $this->hasOne(Topic::class, 'id', 'topic_id');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'country_topic_id', 'id');
    }
}
