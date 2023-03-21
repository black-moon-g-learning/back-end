<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Topic extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    /**
     * countriesTopics
     *
     * @return HasMany
     */
    public function videos(): HasOneThrough
    {
        return $this->hasOneThrough(Video::class, CountryTopic::class);
    }
}
