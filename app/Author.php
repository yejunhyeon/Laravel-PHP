<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // protected $table = 'users'; // Auth모델과 users 테이블 연결
    public $timestamps = false;
    protected $fillable = ['email','password'];
    //  'updated_at','created_at' 컬럼 사용을 취소
}
