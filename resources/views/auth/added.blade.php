@extends('layouts.logout')

@section('content')
<div class="text">
  <div class="user">
  <p>{{session('username')}}さん</p>
  <p>ようこそ！AtlasSNSへ！</p>
  </div>
  <div class="user welcome">
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>
</div>
  <p class="btn btn-danger btn-lg"><a href="/login">ログイン画面へ</a></p>

</div>

@endsection
