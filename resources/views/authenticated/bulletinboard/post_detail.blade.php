<x-sidebar>
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="p-3">
        @if (Auth::id() === $post->user_id)
          <div class="detail_inner_head d-flex justify-content-between align-items-center">
            <div class="category-box">
              @if ($post->subCategories->isNotEmpty())
                @foreach ($post->subCategories as $subCategory)
                  <p>{{ $subCategory->sub_category }}</p>
                @endforeach
              @else
                <p>サブカテゴリーはありません</p>
              @endif
            </div>
            <div>
              <span class="edit-modal-open edit-btn" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
              <a href="#" class="delete-modal-open delete-btn" data-post_id="{{ $post->id }}">削除</a>
            </div>
          </div>
        @endif
        <!-- タイトルのエラーメッセージ -->
        @error('post_title')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        <!-- 投稿内容のエラーメッセージ -->
        @error('post_body')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="contributor d-flex">
          <p class="mt-3" style="font-size: 14px";>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
        <div class="comment_container mt-3">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
            <div class="comment_area border-top">
              <p>
                <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
                <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
              </p>
              <p>{{ $comment->comment }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
    <div class="w-50 p-3">
      <div class="comment_container border m-5">
        <div class="comment_area p-3">
          @error('comment')
            <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
          @enderror
          <p class="m-0">コメントする</p>
          <textarea class="w-100" name="comment" form="commentRequest" style="border: 1px solid rgba(204, 204, 204, 0.5);";></textarea>
          <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
          <div class="text-right">
            <input type="submit" class="btn btn-primary mt-2" form="commentRequest" value="投稿">
          </div>
          <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto p-0" style="border: 1px solid rgba(204, 204, 204, 0.5)";
>
          <input type="text" name="post_title" placeholder="タイトル" class="w-100 no-border">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100 no-border"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
  </div>
  <!--削除確認用モーダル-->
  <div class="modal js-delete-modal">
    <div class="modal__bg js-delete-modal-close"></div>
    <div class="modal__content">
      <p>削除してもよろしいですか？</p>
      <input type="hidden" class="delete-modal-hidden">
      <div class="d-flex justify-content-end">
        <button class="btn btn-secondary js-delete-modal-close">キャンセル</button>
        <button class="btn btn-danger js-delete-confirm">OK</button>
      </div>
    </div>
  </div>
</x-sidebar>
