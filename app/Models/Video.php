<?php

namespace App\Models;

use App\Utils\FullTextSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, FullTextSearch;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'country_topic_id',
        'url',
        'owner_id',
        'image'
    ];

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
