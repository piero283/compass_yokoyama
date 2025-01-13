<x-sidebar>
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="sub_category_ids[]" style="border: 1px solid rgba(204, 204, 204, 0.5);";>
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}">
        <!-- サブカテゴリー表示 -->
        @foreach($main_category->subCategories as $sub_category)
          <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
        @endforeach
        </optgroup>
        @endforeach
      </select>
    </div>
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}" style="border: 1px solid rgba(204, 204, 204, 0.5);";>
    </div>
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body" style="border: 1px solid rgba(204, 204, 204, 0.5);";>{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>


  <!--教師のみ表示-->
  @if (in_array(Auth::user()->role, [1, 2, 3]))
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="main_category">
        @if ($errors->has('main_category_name'))
          <span class="text-danger">{{ $errors->first('main_category_name') }}</span>
        @endif
        <p class="m-0">メインカテゴリー</p>
        <form action="{{ route('main.category.create') }}" method="POST" id="mainCategoryRequest">
          @csrf
          <input type="text" class="w-100 mt-2" name="main_category_name" style="border: 1px solid rgba(204, 204, 204, 0.5);";>
          <input type="submit" value="追加" class="w-100 btn btn-primary p-0 mt-3">
        </form>
      </div>

      <div class="sub_category">
        <!--サブカテゴリーエラー-->
        @if ($errors->has('sub_category_name'))
          <span class="text-danger">{{ $errors->first('sub_category_name') }}</span>
        @endif
        <p class="m-0 mt-4">サブカテゴリー</p>
        <form action="{{ route('sub.category.create') }}" method="post">
          @csrf
          <!-- メインカテゴリーエラー -->
          @if ($errors->has('main_category_id'))
              <span class="text-danger">{{ $errors->first('main_category_id') }}</span>
          @endif
          <select name="main_category_id" class="w-100 mt-2" style="border: 1px solid rgba(204, 204, 204, 0.5);";>
            <option value="">---</option>
            @foreach ($main_categories as $main_category)
                <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
            @endforeach
          </select>
          <input type="text" class="w-100 mt-2" name="sub_category_name" style="border: 1px solid rgba(204, 204, 204, 0.5);";>
          <input type="submit" value="追加" class="w-100 btn btn-primary p-0 mt-2">
        </form>
      </div>
    </div>
  @endif
  </div>
</div>
</x-sidebar>
