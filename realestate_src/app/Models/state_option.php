<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State_option extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];// add 0624 jy
    //[user 지울때 올린 매물 있으면 s_no로 묶여있어서:  photo 삭제(물리적삭제)-> state_option 삭제-> s_info 삭제] 그래서 softdel 추가함
    //cascade 사용해야되는데 방법 잘 모르겠음;;;;
    
    // $fillable : insert, update 할 수 있는 필드 설정
    protected $fillable = [
        's_no'
        ,'s_ele'
        ,'s_parking'
    ];

    protected $primaryKey = 's_no';
}
