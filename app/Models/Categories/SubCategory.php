<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\MainCategory;
use App\Models\Posts\Post;



class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory(){
        // リレーションの定義
        return $this->belongsTo('App\Models\Categories\MainCategory');
    }

    public function posts()
    {
        return $this->belongsToMany(
            'App\Models\Posts\Post', //対応するモデル
            'post_sub_categories', //中間テーブル
            'sub_category_id', //このモデルの外部キー
            'post_id' //Postモデルの外部キー
        );
    }
}
