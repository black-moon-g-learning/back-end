<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $table='users_payment';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_id',
        'payment_id',
        'service_id'
    ];
}
