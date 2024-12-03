<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Like;
use App\Models\Posts\PostComments;
use App\Models\Categories\SubCategory;


class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function likes(){
        return $this->hasMany('App\Models\Posts\Like', 'like_post_id', 'id');
    }

    public function likeCount(){
        return $this->likes()->count();
    }

    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function subCategories()
    {
        return $this->belongsToMany(
            'App\Models\Categories\SubCategory', //対応するモデル
            'post_sub_categories', //中間テーブル
            'post_id', //このモデルの外部キー
            'sub_category_id' //SubCategoryのモデルの外部キー
        );
    }


    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }
}
