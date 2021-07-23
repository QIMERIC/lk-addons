<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'border_id'
    ];

    protected $table = 'user_borders';

    public $timestamps = false;

    public function character()
    {
        return $this->belongsToMany('App\Models\Character\Character');
    }

}
