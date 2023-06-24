<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];//  add 0624 jy
    
    protected $primaryKey = 'p_no'; // add 0624 jy
}
