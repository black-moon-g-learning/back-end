<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video',
        'country_id',
        'user_id'
    ];

    /**
     * country
     *
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id');
    }

    /**
     * owner
     *
     * @return HasOne
     */
    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id');
    }
}
