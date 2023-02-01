<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'role',
        'provider_id',
        'token',
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
    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    /**
     * @return HasOne
     */
    public function service(): HasOne
    {
        return  $this->hasOne(Service::class);
    }

    /**
     * @return HasOne
     */
    public function goal(): HasOne
    {
        return $this->hasOne(Goal::class);
    }

    /**
     * @return HasOne
     */
    public function character(): HasOne
    {
        return $this->hasOne(Character::class);
    }

    /**
     * @return HasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }

    /**
     * @return HasMany
     */
    public function playGame(): HasMany
    {
        return $this->hasMany(UserPlayGame::class);
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(UserPayment::class);
    }

    /**
     * @return HasMany
     */
    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
