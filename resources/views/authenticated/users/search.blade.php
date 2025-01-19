<x-sidebar>
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area w-75">
    @foreach($users as $user)
    <div class="one_person shadow">
      <div class="mx-2 mt-2">
        <span style="color: #999;">ID : </span><span>{{ $user->id }}</span>
      </div>
      <div class="mx-2 mt-2">
        <span style="color: #999;">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}" style="color: #3eaad2;">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div class="mx-2 mt-1">
        <span style="color: #999;">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div class="mx-2 mt-2">
        @if($user->sex == 1)
        <span style="color: #999;">性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span style="color: #999;">性別 : </span><span>女</span>
        @else
        <span style="color: #999;">性別 : </span><span>その他</span>
        @endif
      </div>
      <div class="mx-2 mt-2">
        <span style="color: #999;">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div class="mx-2 mt-2">
        @if($user->role == 1)
        <span style="color: #999;">権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span style="color: #999;">権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span style="color: #999;">権限 : </span><span>講師(英語)</span>
        @else
        <span style="color: #999;">権限 : </span><span>生徒</span>
        @endif
      </div>
      <div class="mx-2 mt-1">
        @if($user->role == 4)
          <span style="color: #999;">選択科目 :</span>
          @if($user->subjects->isNotEmpty())
            @foreach($user->subjects as $subject)
                <span>{{ $subject->subject }}</span>
            @endforeach
          @endif
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <div class="search_area w-25 border">
    <div class="">
      <div class="search-tittle mt-5" style="font-size: 20px;">検索</div>
      <div>
        <input type="text" class="free_word mt-3" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <div class="mt-3">
          <label class="search-tittle">カテゴリ</label>
        </div>
        <div class="">
          <select class="category-tab" form="userSearchRequest" name="category">
            <option value="name">名前</option>
            <option value="id">ID</option>
          </select>
        </div>
      </div>
      <div>
        <div class="mt-3">
          <label class="search-tittle">並び替え</label>
        </div>
        <div class="">
          <select class="category-tab" name="updown" form="userSearchRequest">
            <option value="ASC">昇順</option>
            <option value="DESC">降順</option>
          </select>
        </div>
      </div>
      <div class="mt-4">
        <p class="search_conditions d-flex align-items-center" style="width: 70%; margin-left: 10px; border-bottom: 4px solid rgba(204, 204, 204, 0.5); ";>
          <span class="search-tittle">検索条件の追加</span>
          <span class="dli-chevron-down" style="margin-left: 45%";></span>
        </p>
        <div class="search_conditions_inner d-none">
          <div>
            <div class="mt-3">
              <label class="search-tittle">性別</label>
            </div>
            <span class="me-2">男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div>
            <div class="mt-3">
              <label class="search-tittle">権限</label>
            </div>
            <select name="role" form="userSearchRequest" class="category-tab engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <div class="mt-3">
              <label class="search-tittle">選択科目</label>
            </div>
            @foreach($subjects as $subject)
              <label>{{ $subject->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" form="userSearchRequest"
              @if(in_array($subject->id, (array)request('subjects'))) checked @endif>
            @endforeach
          </div>
        </div>
      </div>
      <div class="mt-5">
        <input class="user-search-button" type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="mt-4">
        <input class="reset-button" type="reset" value="リセット" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</x-sidebar>
