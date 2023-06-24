<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class S_info extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $primaryKey = 's_no'; // 이거 없으면 'id'가 기본값
    
    protected $fillable = [
        'u_no'
        ,'s_name'
        ,'s_add'
        ,'s_type'
        ,'s_size'
        ,'s_fl'
        ,'s_stai'
        ,'s_log'
        ,'s_lat'
        ,'p_deposit'
        ,'p_month'
        ,'animal_size'
    ];
}
