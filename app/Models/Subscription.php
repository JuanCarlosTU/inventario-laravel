<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paypal_subscription_id',
        'status',
        'start_date',
        'next_billing_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
