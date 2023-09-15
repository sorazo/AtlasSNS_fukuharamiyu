<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <div id="top">
                 <h1><a class="atlas" href="/top"><img  src="{{asset('/images/atlas.png')}}"></a></h1>
            </div>
            <div class="accordions">
                <p class="tag">{{ Auth::user()->username }}　さん</p>
                <ul class="qa__block">
                    <li class="qa__item">
                        <p class="qa__head js-ac" ></p>
                        <ul class="qa__body ">
                                <li class="menu"><a href="/top">ホーム</a></li>
                                <li class="menu"><a href="{{ route('profile',['id'=>Auth::user()->id] )}}">プロフィール</a></li>
                                <li class="menu"><a href="/logout">ログアウト</a></li>
                        </ul>
                    </li>
                </ul>
                <p class="icon top"><img src="{{ asset('storage/storage/' . Auth::user()->images) }}"></p>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="side-name">{{ Auth::user()->username }}さんの</p>
                <div class="side-count">
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->follows()->pluck('followed_id') ->count() }}名</p>
                </div>
                <p class="side-b py-4"><a class="follower col-7 btn btn-primary btn-lg" href="/follow-list">フォローリスト</a></p>
                <div class="side-count">
                    <p>フォロワー数</p>
                    <p >{{ Auth::user()->follower()->pluck('following_id') ->count() }}名</p>
                </div>
                <p class="side-b py-4"><a class="follower col-7 btn btn-primary btn-lg" href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="side-c py-4"><a class="follower col-7 btn btn-primary btn-lg" href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('/js/ako.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
