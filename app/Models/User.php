<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'age',
        'gender',
        'country_id',
        'goal',
        'role_id',
        'provider_id',
        'token',
        'image',
        'firebase_uid'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return HasOne
     */
    public function service(): HasOne
    {
        return  $this->hasOne(Service::class, 'id');
    }

    /**
     * @return HasOne
     */
    public function target(): HasOne
    {
        return $this->hasOne(Target::class, 'id');
    }

    /**
     * @return HasOne
     */
    public function character(): HasOne
    {
        return $this->hasOne(Character::class, 'id');
    }

    /**
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id');
    }

    /**
     * @return HasMany
     */
    public function playGame(): HasMany
    {
        return $this->hasMany(UserPlayGame::class, 'id');
    }

    /**
     * @return HasMany
     */
    public function payment(): HasMany
    {
        return $this->HasMany(UserPayment::class);
    }

    /**
     * @return HasMany
     */
    public function video(): HasMany
    {
        return $this->hasMany(Video::class, 'id');
    }
}
