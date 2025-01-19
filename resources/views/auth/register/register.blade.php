<x-guest-layout>
  <form action="{{ route('registerPost') }}" method="POST">
    <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
      <div class="w-25 vh-75 border shadow p-3 register-box" style="background-color:#fff">
        <div class="register_form">
          <div class="d-flex mt-3" style="justify-content:space-between">

            <div class="" style="width:140px">
              <label class="d-block m-0" style="font-size:13px">姓</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 over_name" name="over_name">
              </div>
              @error('over_name')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
              @enderror
            </div>

            <div class="" style="width:140px">
              <label class=" d-block m-0" style="font-size:13px">名</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 under_name" name="under_name">
              </div>
              @error('under_name')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
              @enderror
            </div>

          </div>

          <div class="d-flex mt-3" style="justify-content:space-between">
            <div class="" style="width:140px">
              <label class="d-block m-0" style="font-size:13px">セイ</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 over_name_kana" name="over_name_kana">
              </div>
              @error('over_name_kana')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
              @enderror
            </div>

            <div class="" style="width:140px">
              <label class="d-block m-0" style="font-size:13px">メイ</label>
              <div class="border-bottom border-primary" style="width:140px;">
                <input type="text" style="width:140px;" class="border-0 under_name_kana" name="under_name_kana">
              </div>
              @error('under_name_kana')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
              @enderror
            </div>

          </div>

          <div class="mt-3">
            <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
            <div class="border-bottom border-primary">
              <input type="mail" class="w-100 border-0 mail_address" name="mail_address">
            </div>
            @error('mail_address')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
              @enderror
          </div>
        </div>

        <div class="mt-3 d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center mx-3">
            <input type="radio" name="sex" class="sex mx-2 mb-2" value="1">
            <label style="font-size:13px">男性</label>
          </div>
          <div class="d-flex align-items-center">
            <input type="radio" name="sex" class="sex mx-2 mb-2" value="2">
            <label style="font-size:13px">女性</label>
          </div>
          <div class="d-flex align-items-center mx-4">
            <input type="radio" name="sex" class="sex mx-2 mb-2" value="3">
            <label style="font-size:13px">その他</label>
          </div>
        </div>

        <div class="mt-3">
          <label class="d-block m-0 aa" style="font-size:13px">生年月日</label>
          <div class="d-flex justify-content-start align-items-center">
            <select class="old_year mx-0" name="old_year" style="border: none; border-bottom: 1px solid #007bff; width: 90px;">
              <option value="none">-----</option>
              <option value="1985">1985</option>
              <option value="1986">1986</option>
              <option value="1987">1987</option>
              <option value="1988">1988</option>
              <option value="1989">1989</option>
              <option value="1990">1990</option>
              <option value="1991">1991</option>
              <option value="1992">1992</option>
              <option value="1993">1993</option>
              <option value="1994">1994</option>
              <option value="1995">1995</option>
              <option value="1996">1996</option>
              <option value="1997">1997</option>
              <option value="1998">1998</option>
              <option value="1999">1999</option>
              <option value="2000">2000</option>
              <option value="2001">2001</option>
              <option value="2002">2002</option>
              <option value="2003">2003</option>
              <option value="2004">2004</option>
              <option value="2005">2005</option>
              <option value="2006">2006</option>
              <option value="2007">2007</option>
              <option value="2008">2008</option>
              <option value="2009">2009</option>
              <option value="2010">2010</option>
            </select>
            <label style="font-size:13px; margin-top: 10px;">年</label>
            <select class="old_month mx-4" name="old_month" style="border: none; border-bottom: 1px solid #007bff; width: 90px;">
              <option value="none">-----</option>
              <option value="01">1</option>
              <option value="02">2</option>
              <option value="03">3</option>
              <option value="04">4</option>
              <option value="05">5</option>
              <option value="06">6</option>
              <option value="07">7</option>
              <option value="08">8</option>
              <option value="09">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <label style="font-size:13px; margin-left: -20px; margin-top: 10px;">月</label>
            <select class="old_day mx-4" name="old_day" style="border: none; border-bottom: 1px solid #007bff; width: 90px;">
              <option value="none">-----</option>
              <option value="01">1</option>
              <option value="02">2</option>
              <option value="03">3</option>
              <option value="04">4</option>
              <option value="05">5</option>
              <option value="06">6</option>
              <option value="07">7</option>
              <option value="08">8</option>
              <option value="09">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            <label style="font-size:13px; margin-left: -20px; margin-top: 10px;">日</label>
          </div>
        </div>

        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">役職</label>
          <div class=" d-flex justify-content-between align-items-center">
            <input type="radio" name="role" class="admin_role role" value="1">
            <label class="" style="font-size:13px; margin: 0 0 0 -10px;">教師(国語)</label>
            <input type="radio" name="role" class="admin_role role" value="2">
            <label style="font-size:13px; margin: 0 0 0 -10px;">教師(数学)</label>
            <input type="radio" name="role" class="admin_role role" value="3">
            <label style="font-size:13px; margin: 0 0 0 -10px;">教師(英語)</label>
            <input type="radio" name="role" class="other_role role" value="4">
            <label style="font-size:13px; margin: 0 0 0 -10px;" class="other_role">生徒</label>
          </div>
        </div>
        <div class="select_teacher d-none">
          <label class="d-block m-0" style="font-size:13px">選択科目</label>
          @foreach($subjects as $subject)
            <div class="">
              <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
              <label>{{ $subject->subject }}</label>
            </div>
          @endforeach
        </div>

        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password" name="password">
          </div>
          @error('password')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
          @enderror
        </div>

        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password_confirmation" name="password_confirmation">
          </div>
          @error('password_confirmation')
                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
          @enderror
        </div>

        <div class="mt-3 text-right">
          <input type="submit" class="btn btn-primary register_btn" disabled value="新規登録" onclick="return confirm('登録してよろしいですか？')">
        </div>
        <div class="text-center">
          <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</x-guest-layout>
