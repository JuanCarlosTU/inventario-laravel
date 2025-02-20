<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{

    protected $fillable = ['bien_id','tipo', 'cantidad', 'persona', 'observaciones'];

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
