<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jjim extends Model
{
    use HasFactory;

    protected $fillable = ['s_no', 'id'];

    public $timestamps = false; // created_at, updated_at 안넣기 설정
}
