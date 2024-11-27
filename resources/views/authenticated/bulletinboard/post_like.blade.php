<x-sidebar>
<div class="post_view w-75 mt-5">
  <p class="w-75 m-auto">いいねした投稿</p>
  @foreach($posts as $post)
  <div class="post_area border w-75 m-auto p-3">
    <p>
      <span>{{ $post->user->over_name }}</span>
      <span class="ml-3">{{ $post->user->under_name }}</span>さん
    </p>
    <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
    <div class="post_bottom_area d-flex align-items-center">
      @if(Auth::user()->is_Like($post->id))
      <p class="m-0">
        <!-- いいね解除ボタン -->
        <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}" style="color: red; cursor: pointer;">
          <span class="like_counts{{ $post->id }}">{{ $post->like_count }}</span>
        </i>
      </p>
      @else
      <p class="m-0">
        <!-- いいねボタン -->
        <i class="fas fa-heart like_btn" post_id="{{ $post->id }}" style="color: gray; cursor: pointer;">
          <span class="like_counts{{ $post->id }}">{{ $post->like_count }}</span>
        </i>
      </p>
      @endif
      <!-- いいね数の表示 -->
      <span class="ml-2 like_counts{{ $post->id }}">{{ $post->likes_count }}</span>
    </div>
  </div>
  @endforeach
</div>
</x-sidebar>
