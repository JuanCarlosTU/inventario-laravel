<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paypal_subscription_id',
        'amount',
        'currency',
        'status',
        'payment_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
