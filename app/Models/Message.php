<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'body',
        'order_id',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
