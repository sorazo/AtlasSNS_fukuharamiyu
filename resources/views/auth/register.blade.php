@extends('layouts.logout')

@section('content')
<div class="text">
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<h2 class="main">新規ユーザー登録</h2>

<div class="form">
  <div class="label">
{{ Form::label('ユーザー名') }}
</div>
<div class="input">
{{ Form::text('username',null,['class' => 'input']) }}
</div>
</div>

<div class="form">
  <div class="label">
{{ Form::label('メールアドレス') }}
</div>
<div class="input">
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
</div>

<div class="form">
  <div class="label">
{{ Form::label('パスワード') }}
</div>
<div class="input">
{{ Form::password('password',null,['class' => 'input']) }}
</div>
</div>

<div class="form">
  <div class="label">
{{ Form::label('パスワード確認') }}
</div>
<div class="input">
{{ Form::password('password_confirmation',null,['class' => 'input']) }}
</div>
</div>

<div class="login">
{{ Form::submit('登録',['class' => 'btn btn-danger btn-lg']) }}
</div>

<p class="register"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>


@endsection
