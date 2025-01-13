<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto"></p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p class="post-name">
        <span>{{ $post->user->over_name }}</span>
        <span class="ml-3">{{ $post->user->under_name }}</span>さん
      </p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color: black; font-weight: bold;">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="category-box">
          @if ($post->subCategories->isNotEmpty())
            @foreach ($post->subCategories as $subCategory)
              <p>{{ $subCategory->sub_category }}</p>
            @endforeach
          @else
            <p></p>
          @endif
        </div>
        <div class="d-flex post_status" style="color: #999999;">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="" style="color: black;">{{ $post->post_comments_count }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}" style="color: black;">{{ $post->like_count }}</span></p>
            @else
            <p class="m-0"><i class="far fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}" style="color: black;">{{ $post->like_count }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25">
    <div class="post-wrapper m-4">
      <div class="text-center mt-5"><a href="{{ route('post.input') }}" class="post-button">投稿</a></div>
      <div class="mt-4 search-container">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest" class="search-input">
        <input type="submit" value="検索" form="postSearchRequest" class="search-button">
      </div>
      <div class="category_btns mt-4">
        <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest" style="background-color: #e38eab";>
        <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest" style="background-color: #ebbc5d";>
      </div>
    </div>
    <div class="m-4">
      <div class="">カテゴリー検索</div>
      <ul class="category-list mt-4">
        @foreach ($categories as $category)
          <li class="main-category">
            <p class="toggle-btn">
              {{ $category->main_category }}
              <span class="dli-chevron-down"></span>
            </p>
            <ul class="sub-category-list d-none">
              @foreach ($category->subCategories as $subCategory)
                <li class="mt-2" style="border-bottom: 2px solid #9999";>
                  <a href="{{ route('post.show', ['category_word' => $subCategory->id]) }}">
                    {{ $subCategory->sub_category }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
    </div>

  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
