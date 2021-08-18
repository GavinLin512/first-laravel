<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Builder;

class UserClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone',
        'address'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
//    // 自定義的 query builder function 去作條件判斷
//    // 必須加入 use Illuminate\Database\Eloquent\Builder;
//    // function name 會加一個 scope prefix，呼叫時用 function name 就可以了
//    public function scopeFindUser_id(Builder $builder, $user_id, $operation) {
//        $builder->where('user_id', $operation , $user_id);
//        // 必須去 return builder
//        return $builder;
//    }
}
