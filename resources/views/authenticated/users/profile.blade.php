<x-sidebar>
<div class="vh-100 border">
  <div class="mt-3 mx-3" style="font-size: 18px;">
    <span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
  </div>
  <div class="top_area w-75 m-auto pt-5">
    <div class="user_status p-3">
      <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
      <div>選択科目 :
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
      </div>
      <div class="mt-3">
        @can('admin')
        <span class="subject_edit_btn" style="color: #3eaad2; font-size: 16px;">
          選択科目の登録
          <span class="arrow-icon dli-chevron-down mx-1" style="color: #3eaad2;"></span>
        </span>
        <div class="subject_inner d-none">
          <form action="{{ route('user.edit') }}" method="post" class="subject_form">
            <div class="subject_list_container mt-3">
              @foreach($subject_lists as $subject_list)
              <div class="subject_item mt-2">
                <label>{{ $subject_list->subject }}</label>
                <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
              </div>
              @endforeach
              <input type="submit" value="登録" class="btn btn-primary">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              {{ csrf_field() }}
            </div>
          </form>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>

</x-sidebar>
