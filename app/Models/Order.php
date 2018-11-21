<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'title',
        'body',
        'file_path',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        $this->hasMany(Message::class);
    }

 /*   public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->user_id = auth()->user()->getKey();
        });


    }*/
}
