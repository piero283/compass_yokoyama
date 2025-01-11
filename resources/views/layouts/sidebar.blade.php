<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasBulletinBoard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>
    <body class="all_content">
        <div class="d-flex">
            <div class="sidebar">
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/home.png" alt="ホーム画像" class="" style="width:25px; margin-left:5px;">
                    <a href="{{ route('top.show') }}" class="mt-1">マイページ</a>
                </p>
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/logout.png" alt="ログアウト画像" class="" style="width:25px; margin-left:5px;">
                    <a href="/logout" class="mt-1">ログアウト</a>
                </p>
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/reservation.png" alt="予約画像" class="" style="width:25px; margin-left:5px;">
                    <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}" class="mt-1">スクール予約</a>
                </p>
                <!--教師のみ表示-->
                @if (in_array(Auth::user()->role, [1, 2, 3]))
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/confirmation.png" alt="予約確認画像" class="" style="width:25px; margin-left:5px;">
                    <a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}" class="mt-1">スクール予約確認</a>
                </p>
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/registration.png" alt="登録画像" class="" style="width:25px; margin-left:5px;">
                    <a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}" class="mt-1">スクール枠登録</a>
                </p>
                @endif
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/bulletinboard.png" alt="掲示板画像" class="" style="width:25px; margin-left:5px;">
                    <a href="{{ route('post.show') }}" class="mt-1">掲示板</a>
                </p>
                <p class="d-flex align-items-center mt-3" style="gap: 5px">
                    <img src="/image/search.png" alt="検索画像" class="" style="width:25px; margin-left:5px;">
                    <a href="{{ route('user.show') }}"  class="mt-1">ユーザー検索</a>
                </p>
            </div>
            <div class="main-container">
                {{ $slot }}
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
