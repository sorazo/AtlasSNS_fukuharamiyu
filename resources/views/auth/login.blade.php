@extends('layouts.logout')

@section('content')
<div class="text">
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<h2 class="main">AtlasSNSへようこそ</h2>

<div class="form">
<div class="label">
{{ Form::label('mail adress') }}
</div>
<div class="input">
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
</div>

<div class="form">
<div class="label">
{{ Form::label('password') }}
</div>
<div class="input">
{{ Form::password('password',['class' => 'input']) }}
</div>
</div>

<div class="login">
{{ Form::submit('LOGIN',['class' => 'btn btn-danger btn-lg']) }}
</div>

<p class="register"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
</div>

@endsection
