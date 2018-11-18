<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $ROLES = [
        'admin' => 'Менеджер',
        'client' => 'Клиент',
    ];

    protected $fillable = [
        'name',
        'display',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
