<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class Subject extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    // userテーブルとsubjectテーブルのリレーションの定義
    public function users(){
        return $this->belongsToMany(User::class, 'subject_users', 'subject_id', 'user_id');
    }
}
