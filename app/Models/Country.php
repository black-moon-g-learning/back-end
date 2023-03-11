<?php

namespace App\Models;

use App\Utils\FullTextSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, FullTextSearch;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'continent_id',
        'image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'name'
    ];


    /**
     * @return BelongsTo
     */
    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    /**
     * @return HasMany
     */
    public function countryTopics(): HasMany
    {
        return $this->hasMany(CountryTopic::class);
    }

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function usersPlayGame()
    {
        return $this->hasOne(GamesHistory::class);
    }


    public function setField($id)
    {
        $this->user_play = $id;
    }
}
