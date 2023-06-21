<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State_option extends Model
{
    use HasFactory;
    protected $fillable = [
        's_ele'
        ,'s_parking'
    ];
}
