<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\CommentFormRequest;
use App\Http\Requests\CategoriesFormRequest;
use App\Http\Requests\SubCategoriesFormRequest;


use Auth;

class PostsController extends Controller
{
    public function show(Request $request)
    {
        // 投稿と関連データを取得
        $query = Post::with('user', 'postComments', 'subCategories')
            ->withCount('likes', 'postComments'); // 各投稿のいいね数・コメント数を取得

        // メインカテゴリーを取得
        $categories = MainCategory::get();
        // ログインユーザーのいいね情報を取得
        $userLikes = Auth::user()->likes;
        $userLikes = $userLikes ? $userLikes->pluck('like_post_id')->toArray() : []; // likesがない場合は空配列

        $like = new Like;
        $post_comment = new Post;

        // キーワード検索の実装①
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            // サブカテゴリー名との完全一致を確認
            $subCategory = SubCategory::where('sub_category', $keyword)->first();
            if ($subCategory) {
                // サブカテゴリーに属する投稿を取得
                //sub_categories.id←どのテーブルのidか明示
                $query->whereHas('subCategories', function ($q) use ($subCategory) {
                    $q->where('sub_categories.id', $subCategory->id);
                });
            } else {
                // サブカテゴリー名に一致しない場合、タイトル・投稿内容のあいまい検索
                $query->where(function ($q) use ($keyword) {
                    $q->where('post_title', 'LIKE', "%{$keyword}%")
                    ->orWhere('post', 'LIKE', "%{$keyword}%");
                });
            }
        }
        // カテゴリーフィルター
        if ($request->filled('category_word')) {
            $subCategoryWord = $request->category_word;
            $query->whereHas('subCategories', function ($q) use ($subCategoryWord) {
                $q->where('sub_categories.id', $subCategoryWord);
            });
        }

        // いいねした投稿のフィルター②
        if ($request->filled('like_posts')) {
            $likes = Auth::user()->likePostId()->pluck('like_post_id');
            $query->whereIn('id', $likes);
        }
        // 自分の投稿フィルター③
        if ($request->filled('my_posts')) {
            $query->where('user_id', Auth::id());
        }
        // クエリ結果を取得
        $posts = $query->get();
        // いいね数の取得
        foreach ($posts as $post) {
            $post->like_count = $post->likeCount();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment', 'userLikes'));
    }


    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    //投稿機能
    public function postCreate(PostFormRequest $request)
    {
        //投稿データ作成
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);

        // サブカテゴリーIDを関連付け
        $post->subCategories()->sync($request->sub_category_ids);

        return redirect()->route('post.show');
    }

    //編集機能
    public function postEdit(PostFormRequest $request)
    {
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id])->with('success','投稿が更新されました');
    }

    //投稿削除機能
    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    //メインカテゴリー
    public function mainCategoryCreate(CategoriesFormRequest $request){
        MainCategory::create([
            'main_category' => $request->main_category_name,
        ]);
        return redirect()->route('post.input');
    }

    //サブカテゴリー
    public function subCategoryCreate(SubCategoriesFormRequest $request){
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name,
        ]);
        return redirect()->route('post.input');
    }

    //コメント
    public function commentCreate(CommentFormRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        $likeCount = Like::where('like_post_id', $post_id)->count();
        return response()->json([
        'success' => true,
        'like_count' => $likeCount,
        ]);
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
