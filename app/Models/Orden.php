<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orders';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_number',
        'payment_confirmation',
        'total',
        'created_at',
        'updated_at',
    ];
}
