@extends('layouts.logout')

@section('content')
<div class="text">
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<h2 class="main">新規ユーザー登録</h2>

<div class="form">
  <div class="label">
{{ Form::label('user name') }}
</div>
<div class="input">
{{ Form::text('username',null,['class' => 'input']) }}
</div>
  <div class="error">
    @if ($errors->has('username'))
    <tr>
      <th>ERROR</th>
      @foreach($errors->get('username') as $message)
      <td> {{ $message }} </td>
      @endforeach
    </tr>
    @endif
  </div>
</div>

<div class="form">
  <div class="label">
{{ Form::label('mail adress') }}
</div>
<div class="input">
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
<div class="error">
@if ($errors->has('mail'))
<tr>
  <th>ERROR</th>
  @foreach($errors->get('mail') as $message)
  <td> {{ $message }} </td>
  @endforeach
</tr>
@endif
</div>
</div>

<div class="form">
  <div class="label">
{{ Form::label('password') }}
</div>
<div class="input">
{{ Form::password('password',null,['class' => 'input']) }}
</div>
<div class="error">
  @if ($errors->has('password'))
  <tr>
    <th>ERROR</th>
    @foreach($errors->get('password') as $message)
    <td> {{ $message }} </td>
    @endforeach
  </tr>
  @endif
</div>
</div>

<div class="form">
  <div class="label">
{{ Form::label('password confirm') }}
</div>
<div class="input">
{{ Form::password('password_confirmation',null,['class' => 'input']) }}
</div>
<div class="error">
  @if ($errors->has('password_confirmation'))
  <tr>
    <th>ERROR</th>
    @foreach($errors->get('password_confirmation') as $message)
    <td> {{ $message }} </td>
    @endforeach
  </tr>
  @endif
</div>
</div>

<div class="login">
{{ Form::submit('REGISTER',['class' => 'btn btn-danger btn-lg']) }}
</div>

<p class="register"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>


@endsection
